<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\ApiCountryStats;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\ValidationException;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        if (!is_null($input['referredBy'])) {

            $userRef=User::where('refCode', $input['referredBy'])->first();

        if (is_null($userRef)) {

            throw ValidationException::withMessages(['referredBy' => 'This Referral Code does not belong to any user']);

        } else {
            $countryData = [
                'country' => $input['country'],
            ];
            $countryRequest = new Request($countryData);
            $countryStats = new ApiCountryStats();
            $countryStats->store($countryRequest);

        return User::create([
            'name' => $input['name'],
            'uid' => $input['uid'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'country' => $input['country'],
            'referredBy' => $input['referredBy'],
            'refCode' => $input['refCode'],
            'avatar' => $input['avatar'],
        ]);



    }
} else {
    $countryData = [
        'country' => $input['country'],
    ];
    $countryRequest = new Request($countryData);
    $countryStats = new ApiCountryStats();
    $countryStats->store($countryRequest);

    return User::create([
        'name' => $input['name'],
        'uid' => $input['uid'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
        'country' => $input['country'],
        'referredBy' => 'app',
        'refCode' => $input['refCode'],
        'avatar' => $input['avatar'],
    ]);
}
    }
}