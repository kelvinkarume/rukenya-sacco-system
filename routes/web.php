<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\AdminSavingController;
use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ActivityLogController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Smart Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (!auth()->check()) {
        return redirect('/login');
    }

    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'officer' => redirect()->route('officer.dashboard'),
        'member' => redirect()->route('member.dashboard'),
        default => abort(403),
    };

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        /*
        |--------------------------------------------------------------------------
        | MEMBERS
        |--------------------------------------------------------------------------
        */
        Route::get('/members', [MemberController::class, 'index'])
            ->name('admin.members');

        Route::get('/members/{id}', [MemberController::class, 'show'])
            ->name('admin.members.show');

        Route::post('/members/{id}/toggle', [MemberController::class, 'toggleStatus'])
            ->name('admin.members.toggle');

        /*
        |--------------------------------------------------------------------------
        | SAVINGS
        |--------------------------------------------------------------------------
        */
        Route::get('/savings', [AdminSavingController::class, 'index'])
    ->name('admin.savings');
    Route::get('/savings/{id}', [AdminSavingController::class, 'show'])
    ->name('admin.savings.show');

Route::get('/savings/deposits', [AdminSavingController::class, 'deposits'])
    ->name('admin.savings.deposits');

Route::get('/savings/filter', [AdminSavingController::class, 'filter'])
    ->name('admin.savings.filter');

Route::get('/withdrawals', [AdminSavingController::class, 'withdrawals'])
    ->name('admin.savings.withdrawals');

Route::post('/withdrawals/{id}/approve', [AdminSavingController::class, 'approveWithdrawal'])
    ->name('admin.savings.withdrawals.approve');

Route::post('/withdrawals/{id}/reject', [AdminSavingController::class, 'rejectWithdrawal'])
    ->name('admin.savings.withdrawals.reject');

        /*
        |--------------------------------------------------------------------------
        | LOANS
        |--------------------------------------------------------------------------
        */

        // MAIN LOANS PAGE (REDIRECT)
        Route::get('/loans', function () {
            return redirect()->route('admin.loans.applications');
        })->name('admin.loans');

        // LOAN APPLICATIONS
        Route::get('/loans/applications', [AdminLoanController::class, 'applications'])
            ->name('admin.loans.applications');
Route::post('/loans/{id}/disburse', [AdminLoanController::class, 'disburse'])
    ->name('admin.loans.disburse');
        // ACTIVE LOANS
        Route::get('/loans/active', [AdminLoanController::class, 'active'])
            ->name('admin.loans.active');

        // APPROVE LOAN
        Route::post('/loans/{id}/approve', [AdminLoanController::class, 'approve'])
            ->name('admin.loans.approve');

        // REJECT LOAN
        Route::post('/loans/{id}/reject', [AdminLoanController::class, 'reject'])
            ->name('admin.loans.reject');

        // REPAYMENT HISTORY
        Route::get('/loans/repayments', [AdminLoanController::class, 'repayments'])
            ->name('admin.loans.repayments');
            Route::get('/admin/loans/repayments/{user}', [AdminLoanController::class, 'repaymentDetails'])
    ->name('admin.loans.repayments.details');
   Route::get('/loans/member/{id}', [AdminLoanController::class, 'memberLoans'])
    ->name('admin.loans.member');

        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        Route::get('/notifications', [AdminNotificationController::class, 'index'])
            ->name('admin.notifications');

        Route::patch('/notifications/loans/{id}/approve', [AdminNotificationController::class, 'approveLoan'])
            ->name('admin.notifications.approve-loan');

        Route::patch('/notifications/loans/{id}/reject', [AdminNotificationController::class, 'rejectLoan'])
            ->name('admin.notifications.reject-loan');

        Route::patch('/notifications/withdrawals/{id}/approve', [AdminNotificationController::class, 'approveWithdrawal'])
            ->name('admin.notifications.approve-withdrawal');

        Route::patch('/notifications/withdrawals/{id}/reject', [AdminNotificationController::class, 'rejectWithdrawal'])
            ->name('admin.notifications.reject-withdrawal');

        /*
        |--------------------------------------------------------------------------
        | PAYMENTS
        |--------------------------------------------------------------------------
        */

Route::get('/payments', [AdminPaymentController::class, 'index'])
    ->name('admin.payments');

    
Route::get('/payments/overdue', [AdminPaymentController::class, 'overdue'])
    ->name('admin.payments.overdue');

Route::get('/payments/profit', [AdminPaymentController::class, 'profit'])
    ->name('admin.payments.profit');

        /*
        |--------------------------------------------------------------------------
        | REPORTS
        |--------------------------------------------------------------------------
        */
        Route::get('/reports/loans', [AdminReportController::class, 'loans'])
            ->name('admin.reports.loans');

        Route::get('/reports/repayments', [AdminReportController::class, 'repayments'])
            ->name('admin.reports.repayments');

        Route::get('/reports/savings', [AdminReportController::class, 'savings'])
            ->name('admin.reports.savings');

        Route::get('/reports/overdue', [AdminReportController::class, 'overdue'])
            ->name('admin.reports.overdue');

        Route::get('/reports/profit', [AdminReportController::class, 'profit'])
            ->name('admin.reports.profit');

        Route::get('/reports/savings-withdrawals', [AdminReportController::class, 'savingsWithdrawals'])
            ->name('admin.reports.savings-withdrawals');

        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */
        Route::get('/settings', [SettingController::class, 'index'])
            ->name('admin.settings');

        Route::post('/settings', [SettingController::class, 'store'])
            ->name('admin.settings.save');
    });

    /*
    |--------------------------------------------------------------------------
    | OFFICER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:officer')->group(function () {

        Route::get('/officer/dashboard', function () {
            return view('officer.dashboard');
        })->name('officer.dashboard');

    });

    /*
    |--------------------------------------------------------------------------
    | MEMBER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:member')->group(function () {

        Route::get('/member/dashboard', function () {
            return view('member.dashboard');
        })->name('member.dashboard');

        // SAVINGS
        Route::get('/member/savings', [SavingController::class, 'index'])
            ->name('member.savings');

        Route::get('/savings/create', [SavingController::class, 'create'])
            ->name('savings.create');

        Route::post('/savings', [SavingController::class, 'store'])
            ->name('savings.store');

        Route::get('/savings/withdraw', [SavingController::class, 'withdrawForm'])
            ->name('savings.withdraw');

        Route::post('/savings/withdraw', [SavingController::class, 'processWithdraw'])
            ->name('savings.withdraw.store');

        // LOANS
        Route::get('/member/loans', [LoanController::class, 'index'])
            ->name('member.loans');

        Route::post('/member/loans', [LoanController::class, 'store'])
            ->name('member.loans.store');

        Route::post('/member/loans/{id}/pay', [LoanController::class, 'pay'])
            ->name('member.loans.pay');
            Route::get('/member/history', [LoanController::class, 'loanHistory'])
    ->name('member.loans.history');

        // REPORTS
        Route::get('/member/reports', [ReportController::class, 'index'])
            ->name('member.reports');

           
    });
    Route::middleware(['auth'])->group(function () {

    Route::get('/member/notifications', [NotificationController::class, 'index'])
        ->name('member.notifications');
        Route::get('/member/notifications/read/{id}', [NotificationController::class, 'markAsRead'])
    ->name('member.notifications.read');

});
Route::prefix('member')->middleware(['auth'])->group(function () {

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('member.notifications');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('member.notifications.read');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('member.profile');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('member.profile.update');

    // Activity Logs
    Route::get('/activity-log', [ActivityLogController::class, 'index'])
        ->name('member.activity.log');
});

});

/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', function () {
    return view('home');
})->name('home');
// PRODUCTS PAGES
Route::get('/products/savings', function () {
    return view('products.savings');
})->name('products.savings');

Route::get('/products/loans', function () {
    return view('products.loans');
})->name('products.loans');
/*
|--------------------------------------------------------------------------
| ABOUT US PAGES
|--------------------------------------------------------------------------
*/

Route::get('/about/who-we-are', function () {
    return view('about.who-we-are');
})->name('about.who-we-are');

Route::get('/about/our-journey', function () {
    return view('about.journey');
})->name('about.our-journey');

Route::get('/about/board-of-directors', function () {
    return view('about.board');
})->name('about.board');

Route::get('/about/management-team', function () {
    return view('about.management');
})->name('about.management');

Route::get('/about/members', function () {
    return view('about.members');
})->name('about.members');
/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';