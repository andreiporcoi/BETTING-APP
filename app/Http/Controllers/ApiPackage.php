<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Illuminate\Http\Request;

class ApiPackage extends Controller
{
    

    public function index($type)
    {
        try {
            $packages = Packages::where('type', $type) ->orderBy('created_at', 'desc')->get();

            return response()->json([
                'status' => true,
                'message'=> $packages,
              
            ], 200);
        
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }

    }


}
