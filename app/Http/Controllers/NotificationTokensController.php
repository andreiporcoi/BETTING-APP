<?php

namespace App\Http\Controllers;

use App\Models\NotificationTokens;
use Illuminate\Http\Request;

class NotificationTokensController extends Controller
{

    public function store(Request $request)
    {
        try {

        $userEmail =  auth()->user()->email;
        $userToken = $request->device_key;
        $notificationTokens =NotificationTokens::where('email', $userEmail)->where('device_key', $userToken)->first();

        if (is_null($notificationTokens)) {
            $request = new Request([
                'email'=> $userEmail,
                'device_key' => $userToken
            ]);

            return NotificationTokens::create($request->all());
        }

        return response()->json([
            'status' => true,
            'message' => 'Device Key Stored' ,
        ], 200);

    } catch (\Throwable $th) {

        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);

    }

    }



}
