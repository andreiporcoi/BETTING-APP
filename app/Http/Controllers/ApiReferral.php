<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiReferral extends Controller
{


    public function store(Request $request)
    {
        try {
            $refCode = $request->referredBy;

            if ($refCode != 'app') {

                $refUser = User::where('refCode', $refCode)->first();

                $refereeUid = $refUser['uid'];
                $refereeName = $refUser['name'];
                $refereeEmail = $refUser['email'];
                $refUnCount = $refUser['refUnconfirmCount'] + 1;

                $user = User::where('uid', $refereeUid)->first();
                $user->update([
                    'refUnconfirmCount' => $refUnCount
                ]);


                Referral::create([
                    'refereeCode' => $refCode,
                    'refereeUid' => $refereeUid,
                    'refereeEmail' => $refereeEmail,
                    'refereeName' => $refereeName,
                    'referredUid' => $request->uid,
                    'referredEmail' => $request->email,
                    'referredName' => $request->name,
                    'joinedDate' => Carbon::now(),
                ]);
            }



    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }

    }
}