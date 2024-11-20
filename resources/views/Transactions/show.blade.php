@extends('layouts.app')

@section('title', 'Transaction Overview')
@section('name', 'Transaction Overview')

@section('content')
    @include('layouts.back')

    <div class="bg-white shadow-md rounded-lg mb-6 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Transaction Details (ID: {{ $transaction->id }})</h3>
            <a href="{{ route('transactions.edit', $transaction->id) }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full text-sm flex items-center"
               title="Edit Transaction">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
        </div>

        <div class="text-sm text-gray-700 space-y-3">
            <p><strong>Account Holder:</strong> {{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</p>
            <p><strong>Transaction Amount:</strong> {{ number_format($transaction->amount, 2) }} TZS</p>
            <p>
                <strong>Transaction Type:</strong> 
                <span class="{{ $transaction->type === 'deposit' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold">
                    {{ ucfirst($transaction->type) }}
                </span>
            </p>
            <p><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') }}</p>
        </div>
    </div>
@endsection
