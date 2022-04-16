<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role as ContractsRole;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected function createUser($roleName = 'Admin', $userAttributes = [])
    {
        DB::table('roles')->delete();
        Role::factory()->create(['name' => $roleName]);

        /** @var User */
        $user = User::factory($userAttributes)->create();
        $user->assignRole($roleName);

        return $user;
    }

    protected function createAdminRole()
    {
        DB::table('roles')->where('name', 'Admin')->delete();
        Role::factory()->create(['name' => 'Admin']);
    }
}
