<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'role' => ['required', 'in:student,professor'],
            'verification_code' => ['nullable', 'string'],
        ])->after(function ($validator) use ($input) {
            if ($input['role'] === 'professor') {
                $verificationCode = env('PROFESSOR_VERIFICATION_CODE', 'PROF_2025_KEY');
                if (!isset($input['verification_code']) || $input['verification_code'] !== $verificationCode) {
                    $validator->errors()->add('verification_code', 'The verification code is invalid.');
                }
            }
        })->validate();

        $role = 'student'; // default role

        if ($input['role'] === 'professor' && isset($input['verification_code']) && $input['verification_code'] === 'PROF_2025_KEY') {
            $role = 'professor';
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $role,
            'status' => 'active',
        ]);
    }
}
