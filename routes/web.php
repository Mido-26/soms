<?php 
use App\Models\LoansCartegory;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoansCartController;
use App\Http\Controllers\TransactionsController;

Route::middleware('auth')->group(function () {
    // Change logout route to POST method
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
    // Authenticated routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('profile/{user}', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::patch('profile/{user}/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::Post('dashboard', [DashboardController::class, 'switchUser'])->name('dashboard');
   Route::resource('transactions', TransactionsController::class);

    Route::middleware([RoleMiddleware::class . ':admin,staff'])->group( function () : void {
        Route::resource('savings', SavingController::class);
        Route::resource('members', MembersController::class);
        Route::patch('members/{member}/{todo}', [MembersController::class, 'update'])->name('members.updateAction'); 
        Route::resource('loan-categories', LoansCartController::class);   
    });

    Route::get('/loans', [LoansController::class, 'index'])->name('loans.index');
    Route::get('/loans/pending', [LoansController::class, 'pending'])->name('loans.pending');
    Route::get('/loans/approved', [LoansController::class, 'approved'])->name('loans.approved');
    // Route::resource('loans', LoansController::class);

    Route::get('/unauthorized', function () {
        return view('403');
    })->name('unauthorized');
    // Route for the Settings page (GET request)
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Route for handling form submissions or other actions (POST request)
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Monthly Reports
Route::get('/reports/monthly', [ReportsController::class, 'monthlyReports'])->name('reports.monthly');

// Annual Reports
Route::get('/reports/annual', [ReportsController::class, 'annualReports'])->name('reports.annual');

// Custom Reports
Route::get('/reports/custom', [ReportsController::class, 'customReports'])->name('reports.custom');
Route::get('/development-not-available', function() {
    return view('inprogress');
})->name('inprogress');
});
// Route::resource('members', MembersController::class);
// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::get('/unauthorized', function () {
//     return view('403');
// })->name('unauthorized');
