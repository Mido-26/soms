@extends('layouts.app')
@section('title', 'Transactions Overview')
@section('name', 'Transactions Overview')
@section('content')
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex items-center justify-between my-4">
            <h2 class="text-xl font-semibold text-gray-800">Total Transaction Amount: <span class="text-green-600">{{ number_format($total, 2)}} TZS</span>
            </h2>
                <a href="{{ route('transactions.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-800">
                    <i class="fa-solid fa-circle-plus mr-2"></i> Make New Transaction
                </a>
        </div>

        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Transaction ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account Owner</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount
                            (TZS)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Transaction Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $transaction->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ number_format($transaction->amount, 2) }} TZS
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if ($transaction->type === 'deposit')
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ ucfirst($transaction->type) }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ ucfirst($transaction->type) }}
                                </span>
                            @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $transaction->created_at }}</td>
                            <td class="px-6 py-4 text-sm font-medium flex space-x-4">
                                <!-- View Icon -->
                                <a href="{{ route('transactions.show', $transaction->id) }}"
                                    class="text-blue-600 hover:text-blue-800" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Edit Icon -->
                                <a href="{{ route('transactions.edit', $transaction->id) }}"
                                    class="text-yellow-600 hover:text-yellow-800" title="Edit Transaction">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Icon -->
                                {{-- <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800"
                                        title="Delete Transaction">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No transaction records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination Links -->
            <div class="mt-4 border-t border-gray-400 pt-2">
                {{ $transactions->links('pagination::tailwind') }}
            </div>
        </div>


        <!-- Mobile Card View -->
        <div class="lg:hidden">
            @forelse ($transactions as $transaction)
                <div class="bg-white shadow-md rounded-lg mb-4 p-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Transaction ID: {{ $transaction->id }}</h3>
                        <div class="flex space-x-3">
                            <a href="{{ route('transactions.show', $transaction->id) }}"
                                class="text-blue-600 hover:text-blue-800" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('transactions.edit', $transaction->id) }}"
                                class="text-yellow-600 hover:text-yellow-800" title="Edit Transaction">
                                <i class="fas fa-edit"></i>
                            </a>
                            {{-- <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Delete Transaction">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form> --}}
                        </div>
                    </div>
                    <div class="text-sm text-gray-600">
                        <p><strong>Account Owner:</strong> {{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</p>
                        <p><strong>Amount:</strong> {{ number_format($transaction->amount, 2) }} TZS</p>
                        <p><strong>Type:</strong> <span
                                class="{{ $transaction->type === 'deposit' ? ' bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold">{{ ucfirst($transaction->type) }}</span>
                        </p>
                        <p><strong>Date:</strong> {{ $transaction->created_at }}</p>
                    </div>
                </div>
                <!-- Pagination Links -->
        
            @empty
                <p class="text-center text-gray-500">No transaction records found.</p>
            @endforelse

            <div class="mt-4 border-t border-gray-400 pt-2">
                {{ $transactions->links('pagination::tailwind') }}
            </div>
        </div>
        
    </div>

@endsection
