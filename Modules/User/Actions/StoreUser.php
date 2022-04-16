<?php

namespace Modules\User\Actions;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUser
{
    use AsAction;

    public function handle(array $userData)
    {
        $user = new User();
        $user->name = trim($userData['name']);
        $user->email = trim($userData['email']);
        $user->username = trim($userData['username']);
        $user->password = bcrypt($userData['password']);
        $user->save();

        $user->assignRole('Admin');

        return $user;
    }
}
