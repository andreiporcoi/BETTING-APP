<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ApiAuthUser extends Controller
{


    public function getUser()
    {
        $userEmail =  auth()->user()->email;
        $user = User::where('email', $userEmail)->first();
        return response()->json(
            [
                'status' => true,
                'message' => $user,
            ],
            200
        );
    }


    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validator->errors()->all(),
                    ],
                    422
                );
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json(
                    [
                        'status' => false,
                        'message' =>
                            'Email & Password does not match with our record.',
                    ],
                    401
                );
            }

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                if (is_null($user->email_verified_at)) {
                    // $response = ['message' => 'Email not verified'];
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Email not verified'
                            // $response,
                        ],
                        401
                    );
                } else {
                    if ($user->blocked == 1) {
                        // $response = [
                        //     'message' =>
                        //         'Your Account is suspended, please contact Admin',
                        // ];
                        return response()->json(
                            [
                                'status' => false,
                                'message' =>
                                'Your Account is suspended, please contact Admin',
                                // $response,
                            ],
                            401
                        );
                    } else {
                        $token = $user->createToken('auth_token')
                            ->plainTextToken;

                        $response = ['token' => $token];

                        return response()->json(
                            [
                                'status' => true,
                                'access_token' => $token,
                                'user' => $user,
                                'token_type' => 'Bearer',
                                'message' => 'Login Successful',
                            ],
                            200
                        );
                    }
                }
            } else {
                // $response = ['message' => "Email or password don't match"];
                return response()->json(
                    [
                        'status' => false,
                        'message' => "Email or password don't match"
                        // $response,
                    ],
                    401
                );
            }
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

    public function canRegister(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user) {
                // $response = ['message' => 'User Exists'];
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'User Exists'
                        // $response,
                    ],
                    401
                );
            } else {


                // return response($response,201);
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'ok to register'
                    ],
                    201
                );
            }
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
    public function register(Request $request)
    {
        try {
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


                $miscPermission = Permission::firstOrCreate(['name' => 'N/A']);
                $userRole = Role::firstOrCreate(['name' => 'user'])->syncPermissions([
                        $miscPermission,
                    ]);


                    $countryData = [
                        'country' => $request->country,
                    ];
                    $countryRequest = new Request($countryData);
                    $countryStats = new ApiCountryStats();
                    $countryStats->store($countryRequest);

                    $referral = new ApiReferral();

                $user = User::create([
                    'uid'=>$request->uid,
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'country'=>$request->country,
                    'avatar'=>$request->avatar,
                    'refCode'=>$request->refCode,
                    'referredBy'=>$request->referredBy,
                ])->assignRole($userRole);

                $token = $user->createToken('myapptoken')->plainTextToken;
                $user->sendEmailVerificationNotification();

                // $response = [
                //     'user' => $user,
                //     'token' => $token,
                //     'message'=> 'Registration Successful, check mail'
                // ];

                // return response($response,201);
                return response()->json(
                    [
                        'status' => true,
                        'user' => $user,
                        'token' => $token,
                        'message'=> 'Registration Successful, check mail'
                    ],
                    201
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

    public function logout(Request $request)
    {
        try {
            $request
                ->user()
                ->currentAccessToken()
                ->delete();

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Logged out',
                ],
                201
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

    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validator->errors()->all(),
                    ],
                    422
                );
            }

            $current_password = $request->current_password;
            $new_password = $request->new_password;
            $user_email = auth()->user()->email;
            $user = User::where('email', $user_email)->first();
            if (Hash::check($current_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($new_password),
                ]);

                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Password Updated',
                        //  $response,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => "Old Password don't match",
                    ],
                    401
                );
            }
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

    public function socialRegister(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
            ]);
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $response = ['message' => 'User Exists'];
                return response()->json(
                    [
                        'status' => false,
                        $response,
                    ],
                    401
                );
            } else {
                $token = $user->createToken('myapptoken')->plainTextToken;

                $response = [
                    'user' => $user,
                    'token' => $token,
                ];

                // return response($response,201);
                return response()->json(
                    [
                        'status' => true,
                        $response,
                    ],
                    201
                );
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function socialLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
            ]);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validator->errors()->all(),
                    ],
                    422
                );
            }

            $user = User::where('email', $request->email)->first();

            if ($user) {
                if (is_null($user->email_verified_at)) {
                    $response = ['message' => 'Email not verified'];
                    return response()->json(
                        [
                            'status' => false,
                            $response,
                        ],
                        401
                    );
                } else {
                    $token = $user->createToken('auth_token')->plainTextToken;

                    $response = ['token' => $token];

                    return response()->json(
                        [
                            'status' => true,
                            'access_token' => $token,
                            'user' => $user,
                            'token_type' => 'Bearer',
                            //  $response,
                        ],
                        200
                    );
                }
            } else {
                $response = ['message' => 'call_register'];
                return response()->json(
                    [
                        'status' => false,
                        $response,
                    ],
                    300
                );
            }
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