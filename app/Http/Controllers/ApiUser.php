<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiUser extends Controller
{

    public function index()
    {
        try {

            $userEmail =  auth()->user()->email;
            $user = User::where('email', $userEmail)->first();
            return response()->json([
                'status' => true,
                'message'=> $user,

            ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }

    }


    public function update(Request $request)
    {
        try {
            $userId =  auth()->user()->id;
            //
            $user=User::find($userId);
            $user->update($request->all());
            // return $user;

            return response()->json([
                'status' => true,
                "message" => "Account Updated",
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function destroy()
    {
        try {
            $user_email =  auth()->user()->email;
            $user = User::where('email', $user_email)->first();
            $response = $user->delete();


            if ($response) {

                return response()->json([
                    'status' => true,
                    "message" => "Account Deleted",
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    "message" => "Delete Failed"
                  ], 422);
            }

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
