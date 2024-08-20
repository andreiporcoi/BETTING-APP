<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\DoughnutChartWidget;

class TrxnChart extends DoughnutChartWidget
{
    protected static ?string $heading = 'Users Overview' ;
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {

        $users = User::all();
        $total = count($users);
        $verified =count(User::whereNotNull('email_verified_at')->get());
        $admin =count(User::where('admin', true)->get());
        $blocked =count(User::where('blocked', true)->get());

        return [
            'datasets' => [
                [
                    'label' => 'Users Stats',
                    'data' => [$total, $verified, $admin, $blocked],
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                    ],
                    'borderColor'=> [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    'borderWidth'=> 1
                ],
            ],
            'labels' => ['Total','Verified', 'Admin', 'Blocked' ],
        ];
    }
}
