<?php

namespace Modules\User\Actions;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUser
{
    use AsAction;

    public function handle(int $id, array $userData)
    {
        $user = User::where('id', $id)->first();

        if ($user->hasRole('Admin')) {
            $user->name = trim($userData['name']);
            $user->email = trim($userData['email']);
            $user->username = trim($userData['username']);
            $user->save();
        }

        return $user;
    }
}
