<?php

namespace App\Filament\Widgets;

use App\Models\InvestmentsHistory;
use App\Models\PackageHistory;
use App\Models\Payouts;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $payouts = Payouts::where('status', '2')->get();
        $totalPayouts = $payouts->sum('amount');

        $investments = InvestmentsHistory::all();
        $totalInterests = $investments->sum('interest');

        $packageHistories = PackageHistory::where('title', '!=', 'Rewards')->get();
        $investments = $packageHistories->where('type', 2)->sum('amount');


        return [
            Card::make('Payouts', '$ ' . $totalPayouts)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
       
            Card::make('Interests', '$ ' . $totalInterests)->icon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('danger'),
            Card::make('Investments', '$ ' . $investments)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('warning'),
        ];
    }
}
