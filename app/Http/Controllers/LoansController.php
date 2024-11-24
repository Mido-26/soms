<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use Illuminate\Http\Request;
use App\Models\LoansCartegory;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loans::all();
        // dd($loans->user)
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableLoans = LoansCartegory::all();
        return view('loans.create', compact('availableLoans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $userId = Auth::user()->id;
        $loans = Loans::create( [
            'duration_in_days' => $request->repayment_period,
            'principal_amount' => $request->loan_amount,
            'amount' => $request->loan_amount,
            'interest_rate' => $request->interest_rate,
            'user_id' => $userId,
            'loansCategory_id' => $request->loan_id,
            'description' => $request->loan_id
        ]);
        return redirect()->route('loans.index')->with('success', 'Loan applied successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
