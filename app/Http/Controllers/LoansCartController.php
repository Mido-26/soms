<?php

namespace App\Http\Controllers;

use App\Models\LoansCartegory;
use Illuminate\Http\Request;

class LoansCartController extends Controller
{
    public function index(){
        
        $loanCategories = LoansCartegory::all();
        // dd($loanCategories);
        return view('loan-categories.index', compact('loanCategories'));
    }

    public function create(){
        
        return view('loan-categories.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
            'loanName' => 'required|string|max:255', // Ensure loan name is a string and not too long
            'interest' => 'required|numeric|between:0,100', // Validate interest as a percentage (0-100)
            'dueDatedays' => 'required|integer|min:1', // Ensure due date days is an integer and at least 1
            'minAmount' => 'required|numeric|min:0', // Ensure minimum amount is numeric and non-negative
            'maxAmount' => 'required|numeric|gt:minAmount', // Ensure max amount is numeric and greater than minAmount
    ]);

    LoansCartegory::create($validated);

    // Redirect to the index page with a success message
    return redirect()->route('loan-categories.index')
                     ->with('success', 'Loan category created successfully.');
}

    public function edit(string $id){

        $loanCart = LoansCartegory::findOrFail($id);
        // dd($loanCart);
        
        return view('loan-categories.edit', compact('loanCart'));
    }

    public function show(string $id)
    {
        $loanCategory = LoansCartegory::findOrFail($id);
        return view('loan-categories.show', compact('loanCategory'));
    }

    public function update(Request $request, string $id){

        // dd($request->all());
        $loansCartegory = LoansCartegory::findOrFail($id);
        $validated = $request->validate([
            'loanName' => 'required|string|max:255', // Ensure loan name is a string and not too long
            'interest' => 'required|numeric|between:0,100', // Validate interest as a percentage (0-100)
            'dueDatedays' => 'required|integer|min:1', // Ensure due date days is an integer and at least 1
            'minAmount' => 'required|numeric|min:0', // Ensure minimum amount is numeric and non-negative
            'maxAmount' => 'required|numeric|gt:minAmount', // Ensure max amount is numeric and greater than minAmount
        ]);
        // dd($loansCartegory);
        $loansCartegory->update($validated);

        return redirect()->route('loan-categories.index')
                         ->with('success', 'Loan category updated successfully');

    }
}

    
