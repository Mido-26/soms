@extends('layouts.app')
@section('title', 'Edit Transaction')
@section('name', 'Edit Transaction')
@section('content')
@include('layouts.back')
    <div class="bg-white px-4 py-3 shadow-md rounded-lg w-full max-w-md">
        <form id="transactionForm" action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ $error }}</span>
                    </div>
                @endforeach
            @endif
            @include('layouts.sess_msg')
            <!-- Savings Account Selection -->
            <div>
                <label for="savings_account" class="block text-sm font-medium text-gray-700 mb-1">
                    Savings Account
                </label>
                <div class="relative">
                    <i class="fas fa-id-card absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <select name="savings_account" id="savings_account" required
                        class="block w-full pl-12 rounded-lg border border-gray-300 shadow-sm py-2 pr-4 outline-none focus:ring-indigo-600 focus:border-indigo-600 transition duration-150 ease-in-out">
                        {{-- <option value="" disabled selected>Select Account</option> --}}
                        @foreach ($savingsAccounts as $savings)
                            <option value="{{ $savings->id }}" {{ $savings->user->id === $transaction->user_id  ? 'selected' : '' }}>{{ $savings->id }} - {{ $savings->user->first_name }}
                                {{ $savings->user->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Transaction Type Selection -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                    Transaction Type
                </label>
                <div class="relative">
                    <i class="fas fa-exchange-alt absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <select name="type" id="type" required
                        class="block w-full pl-12 rounded-lg border border-gray-300 shadow-sm py-2 pr-4 outline-nonefocus:ring-indigo-600 focus:border-indigo-600 transition duration-150 ease-in-out">
                        <option value="deposit" {{ $transaction->type === 'deposit' ? 'selected' : ''}}>Deposit</option>
                        <option value="withdrawal" {{ $transaction->type === 'withdrawal' ? 'selected' : ''}}>Withdrawal</option>
                    </select>
                </div>
            </div>

            <!-- Amount Input -->
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">
                    Amount
                </label>
                <div class="relative">
                    <i class="fas fa-dollar-sign absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="number" step="0.01" name="amount" id="amount" required value="{{ $transaction->amount }}"
                        class="block w-full pl-12 rounded-lg border border-gray-300 shadow-sm py-2 pr-4 outline-none focus:ring-indigo-600 focus:border-indigo-600 transition duration-150 ease-in-out"
                        placeholder="Enter amount">
                </div>
            </div>

            <!-- Description Input -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <div class="relative">
                    <i class="fas fa-align-left absolute left-4 top-4 text-gray-400"></i>
                    <textarea name="description" id="description" rows="3"
                        class="block w-full pl-12 rounded-lg border border-gray-300 shadow-sm py-2 pr-4 outline-none focus:ring-indigo-600 focus:border-indigo-600 transition duration-150 ease-in-out"
                        placeholder="Enter transaction description">{{ $transaction->description }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg shadow hover:bg-indigo-600 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition duration-150 ease-in-out">
                    <i class="fas fa-check mr-2"></i>
                    Update Transaction
                </button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('transactionForm');
        const savingsInput = document.getElementById('savings_account');
        const datalist = document.getElementById('savings_list');
        const errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', function(e) {
            const options = Array.from(datalist.options).map(option => option.value);
            if (!options.includes(savingsInput.value)) {
                e.preventDefault();
                errorMessage.classList.remove('hidden');
                savingsInput.classList.add('border-red-500');
            } else {
                errorMessage.classList.add('hidden');
                savingsInput.classList.remove('border-red-500');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#savings_account').select2({
                placeholder: "Select Account",
                allowClear: true,
                width: '100%' // Makes the dropdown fit the container width
            });
        });
    </script>

@endsection
