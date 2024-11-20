@extends('layouts.app')

@section('title', 'Loan Category Overview')
@section('name', 'Loan Category Overview')

@section('content')
    @include('layouts.back')

    <div class="bg-white shadow-md rounded-lg mb-4 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Loan Category ID: {{ $loanCategory->id }}</h3>
            <div class="flex space-x-2">
                <a href="{{ route('loan-categories.edit', $loanCategory->id) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full flex items-center"
                   title="Edit Loan Category">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
            </div>
        </div>

        <div class="text-sm text-gray-600 space-y-2">
            <p><strong>Loan Name:</strong> {{ $loanCategory->loanName }}</p>
            <p><strong>Minimum Amount:</strong> {{ number_format($loanCategory->minAmount, 2) }} TZS</p>
            <p><strong>Maximum Amount:</strong> {{ number_format($loanCategory->maxAmount, 2) }} TZS</p>
            <p><strong>Interest Rate:</strong> {{ $loanCategory->interest }}%</p>
            <p><strong>Loan Due Period:</strong> 
                {{ number_format($loanCategory->dueDatedays / 30, 1) }} months
            </p>
            <p><strong>Created At:</strong> {{ $loanCategory->created_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>
@endsection
