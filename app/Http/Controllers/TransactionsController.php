<?php

namespace App\Http\Controllers;
use App\Http\Middleware;
use App\Models\Savings;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use DB;
class TransactionsController extends Controller
{
    
    public function index(Request $request)
{
    $query = Transactions::query();

    // Filter by Transaction ID
    if ($request->filled('transaction_id')) {
        $query->where('id', $request->input('transaction_id'));
    }

    // Filter by Account Owner (Assuming `user` relationship exists)
    if ($request->filled('account_owner')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->input('account_owner') . '%')
              ->orWhere('last_name', 'like', '%' . $request->input('account_owner') . '%');
        });
    }

    // Filter by Amount
    if ($request->filled('amount')) {
        $query->where('amount', '>=', $request->input('amount'));
    }

    // Filter by Transaction Type
    if ($request->filled('type')) {
        $query->where('type', $request->input('type'));
    }

    // Filter by Date (assuming `created_at` as transaction date)
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->input('date'));
    }

    // Paginate and get filtered results
    $transactions = $query->orderBy('id', 'desc')->paginate(10);

    // Pass the request inputs to the view to retain selected filters
    return view('transactions.index', compact('transactions'))->withInput($request->all());
}


    public function create(){
        $savingsAccounts = Savings::with('user')->get();
        return view('transactions.create', compact('savingsAccounts'));
    }

    

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string',
            'savings_account' => 'required|exists:savings,id', // Ensure the account exists
            'type' => 'required|in:deposit,withdrawal', // Validate transaction type
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Fetch the savings account
            $savingsAccount = Savings::findOrFail($request->savings_account);
            //  dd($savingsAccount);
            $userId = $savingsAccount->user_id;
            // Handle the transaction balance update based on the type (Deposit/Withdrawal)
            if ($request->type == 'deposit') {
                $savingsAccount->account_balance += $request->amount;  // Increase balance on deposit
                $savingsAccount->last_deposit_date = now();
            } elseif ($request->type == 'withdrawal') {
                if ($savingsAccount->account_balance >= $request->amount) {
                    $savingsAccount->account_balance -= $request->amount;  // Decrease balance on withdrawal
                    $savingsAccount->last_deposit_date = now();
                } else {
                    return redirect()->back()->withErrors(['error' => 'Insufficient balance for withdrawal.']);
                }
            }

            // Save the updated savings account balance
            $savingsAccount->save();

            // Create the transaction with polymorphic relationship
            $transaction = Transactions::create([
                'amount' => $request->amount,
                'description' => $request->description,
                'type' => $request->type,  // Store transaction type
                'user_id' => $userId
            ]);

            // Commit the transaction
            DB::commit();

            // Redirect to the transactions index with a success message
            return redirect()->route('transactions.index')->with('success', 'Transaction added successfully and balance updated.');
        } catch (\Exception $e) {
            // Rollback in case of any error
            DB::rollBack();

            // Redirect with error message
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function show(Transactions $transaction){
        // dd($transaction);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transactions $transaction){
        $savingsAccounts = Savings::with('user')->get();
        return view('transactions.edit', compact('savingsAccounts', 'transaction'));
    }


    public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'amount' => 'required|numeric|min:0.01',
        'description' => 'required|string',
        'savings_account' => 'required|exists:savings,id', // Ensure the account exists
        'type' => 'required|in:deposit,withdrawal', // Validate transaction type
    ]);

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Fetch the existing transaction and associated savings account
        $transaction = Transactions::findOrFail($id);
        $savingsAccount = Savings::findOrFail($request->savings_account);
        $userId = $savingsAccount->user_id;

        // Reverse the previous transaction impact on the account balance
        if ($transaction->type == 'deposit') {
            $savingsAccount->account_balance -= $transaction->amount;
        } elseif ($transaction->type == 'withdrawal') {
            $savingsAccount->account_balance += $transaction->amount;
        }

        // Update balance based on new transaction type and amount
        if ($request->type == 'deposit') {
            $savingsAccount->account_balance += $request->amount;
            $savingsAccount->last_deposit_date = now();
        } elseif ($request->type == 'withdrawal') {
            if ($savingsAccount->account_balance >= $request->amount) {
                $savingsAccount->account_balance -= $request->amount;
            } else {
                return redirect()->back()->withErrors(['error' => 'Insufficient balance for withdrawal.']);
            }
        }

        // Save the updated savings account balance
        $savingsAccount->save();

        // Update transaction details
        $transaction->update([
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->type,
            'user_id' => $userId,
        ]);

        // Commit the transaction
        DB::commit();

        // Redirect to transactions index with a success message
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully and balance adjusted.');
    } catch (\Exception $e) {
        // Rollback in case of any error
        DB::rollBack();

        // Redirect with error message
        return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}

}
