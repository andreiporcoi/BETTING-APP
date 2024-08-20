<?php

namespace App\Http\Controllers;

use App\Models\Payouts;
use App\Models\User;
use Illuminate\Http\Request;

class ApiPayouts extends Controller
{
    public function index()
    {
        try {
            $userEmail = auth()->user()->email;

            $payouts = Payouts::where('email', $userEmail)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json(
                [
                    'status' => true,
                    'message' => $payouts,
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                500
            );
        }
    }

    public function store(Request $request)
    {


        try {
            $userEmail = auth()->user()->email;
            $userBalance = auth()->user()->balance;
            $amount = $request->amount;

            if ($userBalance <= 0) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Nothing to request',
                    ],
                    401
                );
            } else {
                if ($userBalance < $amount) {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Not enough balance',
                        ],
                        401
                    );
                } else {


                    Payouts::create([
                        'reference' => $request->reference,
                        'email' => $userEmail,
                        'paymentMethod' => $request->paymentMethod,
                        'fullName' => $request->fullName,
                        'amount' => $amount,
                        'walletAddress' => $request->walletAddress,
                        'payType' => $request->payType,
                        'bankName' => $request->bankName,
                        'accName' => $request->accName,
                        'accNum' => $request->accNum,
                        'bankCountry' => $request->bankCountry,
                        'currency' => $request->currency,
                        'swiftCode' => $request->swiftCode,
                        // 'benAddress' => $request->benAddress,
                        // 'bankBranch' => $request->bankBranch,
                        // 'bankAddress' => $request->bankAdd,
                        // 'createdDate' => $request->createdDate,
                        // 'updatedDate' => $request->updatedDate,
                    ]);

                    $newBalance = $userBalance - $amount;
                    $user = User::where('email', $userEmail)->first();

                    $user->update([
                        'balance' => $newBalance,
                    ]);

                    return response()->json(
                        [
                            'status' => true,
                            'message' => 'Success',
                        ],
                        200
                    );
                }
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                500
            );
        }
    }
}
