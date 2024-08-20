<?php

namespace App\Http\Controllers;

use App\Models\InvestmentsHistory;
use Illuminate\Http\Request;

class ApiInvestmentHistory extends Controller
{
    public function index()
    {
        try {
            $userEmail =  auth()->user()->email;
            $investments = InvestmentsHistory::where('email', $userEmail)->orderBy('created_at', 'desc')->get();

            return response()->json(
                [
                    'status' => true,
                    'message' => $investments,
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