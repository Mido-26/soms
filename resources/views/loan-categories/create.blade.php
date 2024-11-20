@extends('layouts.app')
@section('title', 'Add LoanCartegory')
@section('name', 'Add LoanCartegory')
@section('content')
<div class="max-w-full mx-auto bg-white px-4 py-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Add Loan Category</h2>
    <form action="{{ route('loan-categories.store') }}" method="POST" class="space-y-6">
        @csrf
        <!-- Loan Name -->
        <div>
            <label for="loanName" class="block text-sm font-medium text-gray-700 mb-1">Loan Name</label>
            <div class="relative">
                <i class="fa-solid fa-file-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="loanName" id="loanName" value="{{ old('loanName') }}" required 
                    class="w-full border border-gray-300 rounded-lg pl-10 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                    placeholder="Enter loan name">
            </div>
            @error('loanName')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Minimum and Maximum Amounts -->
        <div class="flex gap-4">
            <!-- Minimum Amount -->
            <div class="flex-1">
                <label for="minAmount" class="block text-sm font-medium text-gray-700 mb-1">Minimum Amount</label>
                <div class="relative">
                    <i class="fa-solid fa-dollar-sign absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="number" name="minAmount" id="minAmount" value="{{ old('minAmount') }}" required step="0.01" 
                        class="w-full border border-gray-300 rounded-lg pl-10 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                        placeholder="Enter minimum amount">
                </div>
                @error('minAmount')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Maximum Amount -->
            <div class="flex-1">
                <label for="maxAmount" class="block text-sm font-medium text-gray-700 mb-1">Maximum Amount</label>
                <div class="relative">
                    <i class="fa-solid fa-dollar-sign absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="number" name="maxAmount" id="maxAmount" value="{{ old('maxAmount') }}" required step="0.01" 
                        class="w-full border border-gray-300 rounded-lg pl-10 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                        placeholder="Enter maximum amount">
                </div>
                @error('maxAmount')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Interest Rate -->
        <div>
            <label for="interest" class="block text-sm font-medium text-gray-700 mb-1">Interest Rate (%)</label>
            <div class="relative">
                <i class="fa-solid fa-percentage absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="number" name="interest" id="interest" value="{{ old('interest') }}" required 
                    class="w-full border border-gray-300 rounded-lg pl-10 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                    placeholder="Enter interest rate">
            </div>
            @error('interest')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Due Date (Days) -->
        <div>
            <label for="dueDatedays" class="block text-sm font-medium text-gray-700 mb-1">Due Date (Days)</label>
            <div class="relative">
                <i class="fa-solid fa-calendar-day absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="number" name="dueDatedays" id="dueDatedays" value="{{ old('dueDatedays') }}" required 
                    class="w-full border border-gray-300 rounded-lg pl-10 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                    placeholder="Enter due date in days">
            </div>
            @error('dueDatedays')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" 
                class="w-full bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                <i class="fa-solid fa-save mr-2"></i> Save Loan Category
            </button>
        </div>
    </form>
</div>

@endsection
