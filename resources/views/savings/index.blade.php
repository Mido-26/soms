@extends('layouts.app')
@section('title', 'Savings')
@section('name', 'Savings Overview')
@section('content')
    {{-- @include('layouts.back') --}}
    <div class="container mx-auto px-4">
        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Savings ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account
                            Balance (TZS)</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interest
                            Earned</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last
                            Deposit Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($savings as $saving)
                        {{-- @dd($savings); --}}
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $saving->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $saving->user->first_name }} {{ $saving->user->last_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ number_format($saving->account_balance, 2) }} TZS
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ number_format($saving->interest_earned, 2) }} TZS
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $saving->last_deposit_date }}</td>
                            <td class="px-6 py-4 text-sm  font-medium flex space-x-4 justify-center align-middle">
                                <!-- View Icon -->
                                <a href="{{ route('savings.show', $saving->id ) }}"
                                     class="text-blue-600 hover:text-blue-800"
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>


                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No savings records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden">
            @forelse ($savings as $saving)
                <div class="bg-white shadow-md rounded-lg mb-4 p-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Savings ID: {{ $saving->id }}</h3>
                        {{-- <div class="flex space-x-3">
                            <a href="{{ route('savings.show', $saving->id) }}" class="text-blue-600 hover:text-blue-800" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('savings.edit', $saving->id) }}" class="text-yellow-600 hover:text-yellow-800" title="Edit Savings">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('savings.destroy', $saving->id) }}" method="POST" class="inline-block" title="Delete Savings">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Delete Savings">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        </div> --}}
                    </div>
                    <div class="text-sm text-gray-600">
                        <p><strong>User ID:</strong> {{ $saving->user->first_name }}</p>
                        <p><strong>Account Balance:</strong> {{ number_format($saving->account_balance, 2) }} TZS</p>
                        <p><strong>Interest Earned:</strong> {{ number_format($saving->interest_earned, 2) }} TZS</p>
                        <p><strong>Last Deposit Date:</strong> {{ $saving->last_deposit_date }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No savings records found.</p>
            @endforelse
        </div>
    </div>


@endsection
