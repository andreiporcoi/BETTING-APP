<?php

namespace App\Filament\Resources\PackageHistoryResource\Pages;

use App\Filament\Resources\PackageHistoryResource;
use App\Models\AdminConfig;
use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPackageHistory extends EditRecord
{
    protected static string $resource = PackageHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // protected function handleRecordUpdate(Model $record, array $data): Model
    // {

    // }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        if ($data['type'] == 2 && $data['status'] == 2) {

            $adminConfig = AdminConfig::where('title', 'refPercent')->first();
            $refPercent =intval($adminConfig->value);
            $amount = floatval($data['amount']);

            $refBonus = $amount * ($refPercent/100);

            $referredUser = Referral::where('referredEmail', $data['email'])->first();
            if ($referredUser != null) {

                if ($referredUser['confirmed'] === 0) {

                    $user = User::where('email', $referredUser->refereeEmail)->first();
                    $newBalance = $user->balance + $refBonus;

                    $user->update([
                        'balance' => $newBalance,
                    ]);

                    $referredUser->update([
                        'confirmed' => 1,
                        'confirmDate' => Carbon::now(),
                    ]);
                }
            }

        }


        $record->update($data);

        return $record;
    }
}
