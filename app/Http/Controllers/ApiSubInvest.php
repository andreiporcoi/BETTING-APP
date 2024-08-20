<?php

namespace App\Http\Controllers;

use App\Models\Investments;
use App\Models\Subscriptions;
use Illuminate\Http\Request;

class ApiSubInvest extends Controller
{
   
    
    public function index($type)
    {
        try {
            $userEmail =  auth()->user()->email;

            if ($type == 'subscription') {
                
                $sub = Subscriptions::where('email', $userEmail)->first();

                if ($sub) {
                  
                    return response()->json([
                        'status' => true,
                        'message'=> $sub,
                      
                    ], 200);
                } else {
                   
                    return response()->json([
                        'status' => false,
                    ], 401);

                }
                
              
            } else {
                $invest = Investments::where('email', $userEmail)->first();

                if ($invest) {
                    return response()->json([
                        'status' => true,
                        'message'=> $invest,
                    ], 200);

                    } else {
                        return response()->json([
                            'status' => false,
                        ], 401);
                    }
                

             
            }
        
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }

    }


}
