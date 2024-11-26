<?php

namespace App\Http\Controllers;
use App\Models\Savings;
use App\Http\Middleware;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use DB;
class TransactionsController extends Controller
{
    
    public function index(Request $request)
{
    $role = session('role');
    $query = Transactions::query();
    if ($role == 'admin' || $role == 'staff'){
        
    }else{
        $id = Auth::user()->id;
        $query->where('user_id', '=', $id);
    }
    // $query = Transactions::query();


    // Paginate and get filtered results
    $transactions = $query->orderBy('id', 'desc')->paginate(10);
    // dd($transactions);
    $total = 0;
        foreach ($transactions as $transaction) {
            $total = $total + $transaction->amount;
        }
    // Pass the request inputs to the view to retain selected filters
    return view('transactions.index', compact('transactions', 'total'))->withInput($request->all());
}


    public function create(){
         if (Auth::user()->role == 'admin') {
                return redirect()->route('unauthorized');
            }
        $savingsAccounts = Savings::with('user')->get();
        return view('transactions.create', compact('savingsAccounts'));
    }

    

    public function store(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('unauthorized');
        }
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
        // dd(Auth::user());
        if (Auth::user()->role == 'admin' || $transaction->user_id === Auth::id()) {
            return redirect()->route('unauthorized');
        }
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transactions $transaction){
        $savingsAccounts = Savings::with('user')->get();
        return view('transactions.edit', compact('savingsAccounts', 'transaction'));
    }


    public function update(Request $request, $id)
{
    if (Auth::user()->role == 'admin') {
        return redirect()->route('unauthorized');
    }
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
