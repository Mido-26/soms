@extends('layouts.app')

@section('title', 'Loan Overview')
@section('name', 'Loan Overview')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">All Loans</h2>
        <button class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 flex items-center">
            <i class="fa fa-plus mr-2"></i> Add New Loan
        </button>
    </div>

    <!-- Loan Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Loan ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Loan Type</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Amount (TZS)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Repayment Period</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Interest Rate (%)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{ dd($loans->) }} --}}
                @if ($loans->isEmpty())
                    <p class="text-center text-gray-600 py-6">No loans available at the moment.</p>
                @else
                    @foreach ($loans as $loan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $loan->id }}</td>
                            <td class="px-4 py-2 border">{{ $loan->user->first_name }}</td>
                            <td class="px-4 py-2 border">{{ number_format($loan->amount, 2) }}</td>
                            <td class="px-4 py-2 border">{{ $loan->duration_in_days }} Months</td>
                            <td class="px-4 py-2 border">{{ $loan->interest_rate }}</td>
                            <td class="px-4 py-2 border">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'disbursed' => 'bg-blue-100 text-blue-800',
                                    ];
                                @endphp
                                <span
                                    class="px-2 py-1 text-sm font-semibold rounded {{ $statusClasses[$loan->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex space-x-2">
                                    <button class="bg-green-500 text-white py-1 px-3 rounded-lg hover:bg-green-600">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="bg-yellow-500 text-white py-1 px-3 rounded-lg hover:bg-yellow-600">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @endif
            </tbody>
        </table>
    </div>
@endsection
