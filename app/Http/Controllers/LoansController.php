<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use Illuminate\Http\Request;
use App\Models\LoanCartegory;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loans::paginate(10);
        // dd($loans->user)
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableLoans = LoanCartegory::all();
        return view('loans.create', compact('availableLoans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $userId = Auth::user()->id;
        $loans = Loans::create( [
            'duration_in_days' => $request->repayment_period,
            'principal_amount' => $request->loan_amount,
            'amount' => $request->return_amount,
            'interest_rate' => $request->interest_rate,
            'user_id' => $userId,
            'loancartegories_id' => $request->loan_id,
            'description' => $request->loan_purpose
        ]);
        return redirect()->route('loans.index')->with('success', 'Loan applied successfully.');
    }

    public function changeStatus(Request $request, Loans $loan)
{
    $request->validate([
        'status' => 'required|in:pending,approved,rejected,disbursed',
    ]);

    $loan->status = $request->status;
    $loan->save();

    return redirect()->route('loans.show', $loan->id)
        ->with('success', 'Loan status updated successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Loans $loan)
    {
        // dd($loan);
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
