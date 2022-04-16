<?php

namespace Modules\User\Actions;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class FindUser
{
    use AsAction;

    public function handle(int $id)
    {
        $user = User::findOrFail($id);

        if (!$user OR $user->hasRole('Super Admin')) {
            throw new ModelNotFoundException;
        }

        return $user;
    }
}
