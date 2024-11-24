@extends('layouts.app')

@section('title', 'Loan Application')
@section('name', 'Loan Application')

@section('content')
<div class="max-w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-600 mb-4">Available Loans</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($availableLoans as $loan)
        <div class="border border-gray-300 rounded-lg p-6 shadow-sm transition-transform transform hover:scale-103 hover:shadow-lg">
            <div class="flex items-center space-x-4 mb-4">
                <div class="p-2 bg-blue-100 rounded-full text-blue-600">
                    <i class="fa fa-money-bill-alt text-xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $loan->loanName }}</h2>
            </div>
            <p class="text-gray-600 mb-2"><i class="fa fa-dollar-sign text-blue-600 mr-2"></i> Maximum Amount: TZS {{ number_format($loan->maxAmount) }}</p>
            <p class="text-gray-600 mb-4"><i class="fa fa-percentage text-blue-600 mr-2"></i> Interest Rate: {{ $loan->interest }}%</p>
            <button onclick="showApplicationForm({{ $loan->id }}, '{{ $loan->loanName }}', {{ $loan->interest }})" 
                class="w-full bg-blue-600 text-white font-medium py-2 rounded-md shadow-md hover:bg-blue-700 transition duration-200 transform hover:scale-105">
                <i class="fa fa-pencil mr-2"></i> Apply Now
            </button>
        </div>
        @endforeach
            
    </div>

    <!-- Application Form Modal -->
    <div id="applicationFormModal" class="fixed inset-0 bg-gray-800 bg-opacity-60 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-lg w-full sm:max-w-xl md:max-w-2xl lg:max-w-3xl transform scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-600 flex items-center">
                    <i class="fa fa-file-alt text-blue-600 mr-3"></i> Apply for Loan
                </h2>
                <button type="button" onclick="closeApplicationForm()" class="text-gray-500 hover:text-gray-700 transition duration-200">
                    <i class="fa fa-times text-xl"></i>
                </button>
            </div>

            <form action="{{ route('loans.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" id="loan_id" name="loan_id">
                <input type="hidden" id="interest_rate" name="interest_rate">
                <!-- Loan Type -->
                <div>
                    <label for="loan_name" class="block text-sm font-medium text-gray-700 mb-1">Loan Type</label>
                    <div class="relative">
                        <i class="fa fa-cogs absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="loan_name" name="loan_name" readonly class="w-full border border-gray-300 rounded-lg pl-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Loan Type">
                    </div>
                </div>

                <!-- Requested Loan Amount -->
                <div class="relative">
                    <label for="loan_amount" class="block text-sm font-medium text-gray-700 mb-1">Requested Loan Amount (TZS)</label>
                    <div class="relative">
                        <i class="fa fa-dollar-sign absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="number" id="loan_amount" name="loan_amount" required class="w-full border border-gray-300 rounded-lg pl-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" oninput="calculateReturn()" placeholder="Enter loan amount">
                    </div>
                </div>

                <!-- Repayment Period -->
                <div class="relative">
                    <label for="repayment_period" class="block text-sm font-medium text-gray-700 mb-1">Repayment Period (Months)</label>
                    <div class="relative">
                        <i class="fa fa-calendar absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="number" id="repayment_period" name="repayment_period" required class="w-full border border-gray-300 rounded-lg pl-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" oninput="calculateReturn()" placeholder="Enter repayment period">
                    </div>
                </div>

                <!-- Loan Purpose -->
                <div>
                    <label for="loan_purpose" class="block text-sm font-medium text-gray-700 mb-1">Purpose of the Loan</label>
                    <textarea id="loan_purpose" name="loan_purpose" rows="3" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter the purpose of the loan"></textarea>
                </div>

                <!-- Total Repayment Amount -->
                <div class="relative">
                    <label for="return_amount" class="block text-sm font-medium text-gray-700 mb-1">Total Repayment Amount (TZS)</label>
                    <div class="relative">
                        <i class="fa fa-calculator absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="return_amount" name="return_amount" readonly class="w-full border border-gray-300 rounded-lg pl-10 py-2 text-gray-500 bg-gray-100" placeholder="Total repayment will be calculated" readonly>
                    </div>
                </div>

                <!-- Loading Indicator -->
                <div id="loadingIndicator" class="hidden text-center text-gray-600">
                    <i class="fa fa-spinner fa-spin"></i> Loading...
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeApplicationForm()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                        <i class="fa fa-times-circle mr-2"></i> Cancel
                    </button>
                    <button type="submit" onclick="showLoading()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fa fa-paper-plane mr-2"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let loanInterestRate = 0; // Default interest rate

    // Function to show loan application form
    function showApplicationForm(loanId, loanName, interestRate) {
        loanInterestRate = interestRate / 100;  // Convert interest to decimal
        document.getElementById('loan_id').value = loanId;
        document.getElementById('interest_rate').value = interestRate;
        document.getElementById('loan_name').value = loanName;
        const modal = document.getElementById('applicationFormModal');
        modal.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
        modal.classList.add('opacity-100', 'pointer-events-auto', 'scale-100');
    }

    // Function to close the loan application form
    function closeApplicationForm() {
        const modal = document.getElementById('applicationFormModal');
        modal.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
        modal.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
    }

    // Function to calculate total repayment amount based on loan amount and repayment period
    function calculateReturn() {
        const loanAmount = parseFloat(document.getElementById('loan_amount').value);
        const repaymentPeriod = parseFloat(document.getElementById('repayment_period').value);

        if (!isNaN(loanAmount) && !isNaN(repaymentPeriod)) {
            const totalAmount = loanAmount + (loanAmount * loanInterestRate * (repaymentPeriod * 30) / 365); // assuming 30 days per month
            document.getElementById('return_amount').value = totalAmount.toFixed(2);  // Display the calculated total amount
        }
    }

    function showLoading() {
        document.getElementById('loadingIndicator').classList.remove('hidden');
    }
</script>
@endsection
