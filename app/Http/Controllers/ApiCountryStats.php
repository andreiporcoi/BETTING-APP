<?php

namespace App\Http\Controllers;

use App\Models\AdminCountries;
use Illuminate\Http\Request;

class ApiCountryStats extends Controller
{
   
    public function store(Request $request)
    {
      
        try {
            $adminCountryCount = AdminCountries::where('country', $request->country)->first();

            if ($adminCountryCount) {
                $newCount = $adminCountryCount['count'] + 1;
                $adminCountryCount->update([
                    'count' => $newCount,
                ]);
                
            } else {
                AdminCountries::create([
                    'country' => $request->country,
                    'count' => 1
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
