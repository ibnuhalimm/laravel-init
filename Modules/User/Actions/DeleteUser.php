<?php

namespace Modules\User\Actions;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUser
{
    use AsAction;

    public function handle(int $id)
    {
        $user = FindUser::make()->handle($id);
        $user->delete();

        return $user;
    }
}
