<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use App\Models\PackageHistory;
use Illuminate\Http\Request;

class ApiCoin extends Controller
{
    

    public function store(Request $request)
    {

        try {
        
        $userEmail =  auth()->user()->email;

        $userCoins = Coins::where('email', $userEmail)->first();

        $balance  = $userCoins['coins'] + $request->quantity;
        $userCoins->update([
            'coins'=>$balance
        ]);

            PackageHistory::create([
                'email'=> $userEmail,
                "reference" => $request->reference,
                "title" => $request->title,
                "amount" => $request->amount,
                "quantity" => $request->quantity,
                "duration" => 0,
                "roi" => 0,
                "startDate" => 0,
                "endDate" => 0,
                "type" => 0,
               ]);

    
            return response()->json([
                'status' => true,
                'message'=> 'Coin purchase successful',
              
            ], 200);


    } catch (\Throwable $th) {
       
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);

    }

    }

}
