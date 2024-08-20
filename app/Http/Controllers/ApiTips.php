<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use App\Models\FreeTips;
use App\Models\PaidTips;
use App\Models\PurchasedTips;
use Illuminate\Http\Request;

class ApiTips extends Controller
{
    public function index($type, $sportDate)
    {
        try {
            if ($type === 'freeTips') {
                $free = FreeTips::where('sportDate', $sportDate)
                    ->orderBy('created_at', 'desc')
                    ->get();

                return response()->json(
                    [
                        'status' => true,
                        'message' => $free,
                    ],
                    200
                );
            } else {
                $paid = PaidTips::where('sportDate', $sportDate)
                    ->orderBy('created_at', 'desc')
                    ->get();

                return response()->json(
                    [
                        'status' => true,
                        'message' => $paid,
                    ],
                    200
                );
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

    public function store(Request $request)
    {
        try {
            $userEmail = auth()->user()->email;
            $purchasedTips = PurchasedTips::where('email', $userEmail)
                ->where('sportId', $request->sportId)
                ->where('sportDate', $request->sportDate);
            if ($purchasedTips) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Tip Already Purchased',
                    ],
                    401
                );
            } else {
                $coins = Coins::where('email', $userEmail)->first();
                $coinBalance = $coins['coins'];

                if ($coinBalance > $request->amount) {
                    $balance = $coinBalance - $request->amount;
                    $coins->update([
                        'coins' => $balance,
                    ]);

                    PurchasedTips::create([
                        'sportId' => $request->sportId,
                        'email' => $userEmail,
                        'amount' => $request->amount,
                        'sportDate' => $request->sportDate,
                    ]);

                    return response()->json(
                        [
                            'status' => true,
                            'message' => 'Tips Purchased',
                        ],
                        200
                    );
                } else {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Not enough balance',
                        ],
                        401
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

    public function purchasedTipsFxn($sportId, $sportDate)
    {
        try {
            $userEmail = auth()->user()->email;

            $purchasedTips = PurchasedTips::where('email', $userEmail)
                ->where('sportId', $sportId)
                ->where('sportDate', $sportDate);

            if ($purchasedTips) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => $purchasedTips,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                    ],
                    401
                );
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
