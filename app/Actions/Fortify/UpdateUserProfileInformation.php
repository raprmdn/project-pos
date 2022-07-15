<?php

namespace App\Actions\Fortify;

use App\Traits\ImageTrait;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    use ImageTrait;
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $validationRules = [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
        ];
        if (!empty($input['photo'])) {
            $validationRules['photo'] = ['mimes:png,jpg,jpeg', 'max:4096'];
        }
        Validator::make($input, $validationRules)->validateWithBag('updateProfileInformation');

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }

        if (!empty($input['photo'])) {
            if ($this->isExistPhoto()) {
                Storage::delete($user->photo);
            }
            $input['photo'] = $this->assignPicture('profile/images', $input['photo'], Str::slug($user->name));
        }

        try {
            $user->update($this->_fields($input));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    protected function _fields(array $input): array
    {
        return [
            'name' => $input['name'],
            'email' => $input['email'],
            'photo' => empty($input['photo']) ? auth()->user()->photo : $input['photo'],
        ];
    }

    protected function isExistPhoto(): bool
    {
        return !is_null(auth()->user()->photo) && Storage::disk('public')->exists(auth()->user()->photo);
    }
}
