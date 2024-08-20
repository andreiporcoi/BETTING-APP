<?php

namespace App\Http\Controllers;

use App\Models\Investments;
use App\Models\PackageHistory;
use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiInvestment extends Controller
{
    public function index()
    {
        try {
            $investments = Investments::orderBy('created_at', 'desc')->get();

            return response()->json(
                [
                    'status' => true,
                    'message' => $investments,
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
            $userEmail = $request->email;

            $activeInvestment = Investments::where('email', $userEmail)
                ->where('status', 1)
                ->first();
            $activePackage = PackageHistory::where('email', $userEmail)
                ->where('type', 2)
                ->where('status', 1)
                ->first();

            if ($activeInvestment || $activePackage) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Already have an active investment',
                    ],
                    401
                );
            } else {

                $referredUser = Referral::where('referredEmail', $userEmail)->first();

                if ($referredUser['confirmed'] === 0) {

                    # code...

                    $referredUser->update([
                        'confirmed' => 1,
                        'confirmDate' => Carbon::now(),
                    ]);
                }

                // confirmed
                // confirmDate
                $user = User::where('email', $userEmail)->first();
                $referredBy = $user->referredBy;
                $referralUser = User::where('refCode', $referredBy)->first();

                if ($user) {
                    # code...
                } else {

                }


                PackageHistory::create([
                    'email' => $userEmail,
                    'reference' => $request->reference,
                    'title' => $request->title,
                    'amount' => $request->amount,
                    'quantity' => 0,
                    'duration' => $request->duration,
                    'roi' => $request->roi,
                    'startDate' => $request->startDate,
                    'endDate' => $request->endDate,
                    'type' => $request->type,
                    'status' => $request->status,
                    'payMethod' => $request->payMethod,
                    'hash' => $request->hash,
                ]);

                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Investment successful',
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

      public function imageUpload(Request $request)
    {
        try {
            $userEmail = $request->email;

            $activeInvestment = Investments::where('email', $userEmail)
                ->where('status', 1)
                ->first();
            $activePackage = PackageHistory::where('email', $userEmail)
                ->where('type', 2)
                ->where('status', 1)
                ->first();

            if ($activeInvestment || $activePackage) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Already have an active investment',
                    ],
                    401
                );
            } else {

                if ($request->has('image')) {
                    $file = $request->file('image');
                    $fileName = $file->getClientOriginalName(); // You can use a custom filename if needed
                    $file->move(storage_path('app/public'), $fileName);
                    $publicUrl = env('APP_URL') . '/core/storage/app/public/' . $fileName;

                }

                return response()->json(
                    [
                        'status' => true,
                        'message' => $publicUrl,
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



}
