@extends('layouts.app')
@section('title', 'Loans-Cartegory')
@section('name', 'Loans Cartegory')
@section('content')
    <div class="max-w-full mx-auto bg-white px-6 py-8 shadow-lg rounded-lg">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Loan Categories</h2>
            <a href="{{ route('loan-categories.create') }}"
                class="inline-flex items-center justify-center text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-all duration-300">
                <i class="fa-solid fa-plus mr-2"></i> Add Loan Category
            </a>

        </div>
        @include('layouts.sess_msg')
        <!-- Search and Filter Section -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 gap-4">
            <!-- Search Input -->
            <div class="relative w-full md:w-1/2">
                <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="searchInput" placeholder="Search loan categories..."
                    class="pl-10 py-2 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Filter Dropdown -->
            <div class="relative w-full md:w-1/4">
                <select id="filterDropdown"
                    class="py-2 px-4 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="all">All Categories</option>
                    <option value="high-interest">High Interest (>10%)</option>
                    <option value="low-interest">Low Interest (<=10%)< /option>
                </select>
            </div>
        </div>

        <!-- Table Section -->
        @if ($loanCategories->isEmpty())
            <!-- No Loan Categories Message -->
            <div class="text-center py-10">
                <p class="text-gray-600 text-lg mb-4">No loan categories found. Add a new category to get started.</p>
                <a href="{{ route('loan-categories.create') }}"
                    class="text-green-600 font-semibold hover:text-green-800 underline">
                    <i class="fa-solid fa-plus mr-1"></i> Add Loan Category
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto bg-white border-collapse border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">Loan
                                Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">Min
                                Amount</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">Max
                                Amount</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">
                                Interest (%)</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">Due
                                Days</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 uppercase tracking-wide">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loanCategories as $loanCategory)
                            <tr class="hover:bg-gray-50 border-b border-gray-200 loan-row"
                                data-interest="{{ $loanCategory->interest_rate }}">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $loanCategory->loanName }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">TZS
                                    {{ number_format($loanCategory->minAmount, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">TZS
                                    {{ number_format($loanCategory->maxAmount, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $loanCategory->interest }}%</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $loanCategory->dueDatedays }} days</td>
                                <td
                                    class="px-6 py-4 text-center text-sm text-gray-800 flex items-center justify-center gap-3">
                                    <!-- Show Button -->
                                    <a href="{{ route('loan-categories.show', $loanCategory->id) }}"
                                        class="text-blue-600 hover:text-blue-800" title="View Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <!-- Edit Button -->
                                    <a href="{{ route('loan-categories.edit', $loanCategory->id) }}"
                                        class="text-green-600 hover:text-green-800" title="Edit">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const filterDropdown = document.getElementById('filterDropdown');
            const tableRows = document.querySelectorAll('.loan-row');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const filterOption = filterDropdown.value;

                tableRows.forEach(row => {
                    const loanName = row.children[0].textContent.toLowerCase();
                    const interestRate = parseFloat(row.dataset.interest);

                    const matchesSearch = loanName.includes(searchTerm);
                    let matchesFilter = true;

                    if (filterOption === 'high-interest' && interestRate <= 10) {
                        matchesFilter = false;
                    } else if (filterOption === 'low-interest' && interestRate > 10) {
                        matchesFilter = false;
                    }

                    row.style.display = matchesSearch && matchesFilter ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterTable);
            filterDropdown.addEventListener('change', filterTable);
        });
    </script>

@endsection
