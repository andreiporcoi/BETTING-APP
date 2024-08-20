<?php

namespace App\Console\Commands;

use App\Models\Interests;
use App\Models\Investments;
use App\Models\InvestmentsHistory;
use App\Models\User;
use App\Models\UserBalances;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InterestReturn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'interest:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disburse Return on Investment to Users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        try {


            $time_now = now(); // Assuming you need current time

            $investments = Investments::where('status', '1')->get();

            foreach ($investments as $investment) {
                $startDate = $investment->startDate;
                $nextDate = $investment->nextDate;
                $endDate = $investment->endDate;
                $email = $investment->email;
                $amount = $investment->amount;
                $roi = $investment->roi;

                $interest = ($amount / 100) * $roi;

                if ($time_now < $nextDate) {
                    echo 'not time yet';
                } elseif ($time_now >= $nextDate && $nextDate < $endDate) {
                    $user = User::where('email', $email)->first();
                    $balance = $user->balance;
                    $newBalance = $balance + $interest;

                    DB::transaction(function () use ($email, $newBalance, $interest, $nextDate, $amount, $startDate, $endDate, $roi ) {
                        User::where('email', $email)->update(['balance' => $newBalance]);
                        $nextDate = Carbon::parse($nextDate)->addDays(7);

                        Investments::where('email', $email)->update(['nextDate' => $nextDate]);
                        InvestmentsHistory::create([
                            'reference' =>Str::random(8),
                            'email' => $email,
                            'interest' => $interest,
                            'amount' => $amount,
                            'startDate' => $startDate,
                            'nextDate' => $nextDate,
                            'endDate' => $endDate,
                            'roi' => $roi,
                        ]);
                        // log history
                        // Add your history insertion here
                    });

                    echo 'Disbursed';
                } elseif ($nextDate >= $endDate) {
                    Investments::where('email', $email)->update(['status' => '2']);
                    echo 'Ended';
                }
            }

        } catch (\Throwable $th) {
            $this->info('error '.$th->getMessage());

        }

        $this->info('Finish');

        return Command::SUCCESS;
    }
}