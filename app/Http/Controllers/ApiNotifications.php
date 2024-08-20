<?php

namespace App\Http\Controllers;

use App\Models\NotificationTokens;
use Illuminate\Http\Request;

class ApiNotifications extends Controller
{


    public function store(Request $request)
    {

        try {

            $notificationTokens = NotificationTokens::where('token', $request->token)->first();

            if (is_null($notificationTokens)) {
                NotificationTokens::create([
                    'uid'=> $request->uid,
                    'token'=>$request->token,
                ]);

                return response()->json([
                    'status' => true,
                    'message'=> 'Token added',

                ], 200);


            } else {

                return response()->json([
                    'status' => false,
                    'message'=> 'Token exist',

                ], 401);

            }



        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);

        }

    }
}