<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;

class ApiAds extends Controller
{
    public function adsGet($adsType)
    {
        try {
            $ads = Ads::where('adsType', $adsType)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json(
                [
                    'status' => true,
                    'message' => $ads,
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
}
