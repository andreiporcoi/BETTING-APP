<?php

namespace App\Filament\Widgets;

use App\Models\PackageHistory;
use Filament\Widgets\BarChartWidget;

class SubChart extends BarChartWidget
{
    protected static ?string $heading = 'Transaction Overview';

    protected function getData(): array
    {
        // $depoTrxns = Transactions::where('trnx_type', 'deposit')->where('status', 'completed')->get();
        // $withdrawTrxns = Transactions::where('trnx_type', 'withdraw')->where('status', 'completed')->get();
        // $interestStats = Interests::all();
        // $investStats = Investments::all();

        // $totDeposit = $depoTrxns->sum('amount');
        // $totWithdraw = $withdrawTrxns->sum('amount');
        // $totInterests = $interestStats->sum('amount');
        // $totInvest = $investStats->sum('amount');

        $packageHistories = PackageHistory::where('title', '!=', 'Rewards')->get();

        $coins = $packageHistories->where('type', 0)->sum('amount');
        $subscriptions = $packageHistories->where('type', 1)->sum('amount');
     


        return [
            'datasets' => [
                [
                    'label' => 'Packages',
                    'data' => [$coins, $subscriptions],
                    'backgroundColor' => [
                        'rgba(54, 207, 30, 0.8)',
                        'rgba(207, 30, 78  , 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',

                    ],
                    'borderColor'=> [
                        'rgba(54, 207, 30, 1)',
                        'rgba(207, 30, 78  , 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',

                    ],
                    'borderWidth'=> 1
                ],
            ],
            'labels' => ['Coins', 'Subscriptions'],
        ];
    }
}
