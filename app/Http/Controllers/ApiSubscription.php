<?php

namespace App\Http\Controllers;

use App\Models\PackageHistory;
use App\Models\Subscriptions;
use Illuminate\Http\Request;

class ApiSubscription extends Controller
{
   public function store(Request $request)
   {
    try {

        $userEmail =  auth()->user()->email;
        $subscription =  Subscriptions::where('email', $userEmail)->first();

        if ($subscription) {
            $time_now=strtotime(date("Y-m-d h:i:sa"));

            $status = ($time_now * 1000) < $subscription['endDate'];

            if ($status) {

                return response()->json([
                    'status' => false,
                    'message' => 'Already have an active subscription'
                ], 401);
                } else {

                    $subscription->update([
                        'title' => $request->title,
                        'amount' => $request->amount,
                        'duration' => $request->duration,
                        'roi' => $request->roi,
                        'startDate' => $request->startDate,
                        'endDate' => $request->endDate,
                    ]);


                }
            
        } else {
            Subscriptions::create([
                'email' => $userEmail,
                'title' => $request->title,
                'amount' => $request->amount,
                'duration' => $request->duration,
                'roi' => $request->roi,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
            ]);
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
        ]);
        
        return response()->json([
            'status' => true,
            'message'=> 'Subscription successful',
          
        ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }
}
