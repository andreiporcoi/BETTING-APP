<?php

namespace App\Http\Controllers;

use App\Models\PackageHistory;
use Illuminate\Http\Request;

class ApiPackageHistory extends Controller
{
    
    public function index($type)
    {
        try {

            $userEmail =  auth()->user()->email;

            $packageHistory = PackageHistory::where('email', $userEmail)->where('type', $type) ->orderBy('created_at', 'desc')->get();

            return response()->json([
                'status' => true,
                'message'=> $packageHistory,
              
            ], 200);
        
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }

    }
}
