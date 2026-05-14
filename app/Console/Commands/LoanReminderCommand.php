<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LoanReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:loan-reminder-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $users = User::with('loans')->get();

    foreach ($users as $user) {

        $activeLoans = $user->loans()->where('status', 'approved')->get();

        if ($activeLoans->count() > 0) {

            Notification::create([
                'user_id' => $user->id,
                'title' => 'Loan Payment Reminder',
                'message' => 'Please remember to repay your active loan this month.',
                'type' => 'loan_reminder'
            ]);
        }
    }
}
}
