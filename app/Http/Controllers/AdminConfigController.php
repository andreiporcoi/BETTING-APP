<?php

namespace App\Http\Controllers;

use App\Models\AdminConfig;
use App\Models\AppLogo;
use Illuminate\Http\Request;

class AdminConfigController extends Controller
{

    public function index()
    {

       try {

        $configs = AdminConfig::all();
        $appLogo = AppLogo::all()->first();
            $configs[] = $appLogo;
        return response()->json([
            'status' => true,
            'message' => $configs,
        ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}