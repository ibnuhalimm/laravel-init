<?php

namespace Modules\User\Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;

class UserDeleteTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Setup the test
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->createAdminRole();
    }

    /** @test */
    public function superadmin_can_delete_admin_user()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $adminUser = $this->createUser('Admin');

        $this->postJson(route('user.delete', [ 'id' => $adminUser->id ]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->has('message')
                    ->has('data');
            });

        $userData = [
            'id' => $adminUser->id,
            'name' => $adminUser->name,
            'email' => $adminUser->email,
            'username' => $adminUser->username
        ];

        $this->assertSoftDeleted(User::class, $userData);
    }

    /** @test */
    public function superadmin_user_unable_to_delete()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $otherSuperAdmin = $this->createUser('Super Admin');

        $this->postJson(route('user.delete', [ 'id' => $otherSuperAdmin->id ]))
            ->assertStatus(Response::HTTP_NOT_FOUND);

        $userData = [
            'id' => $otherSuperAdmin->id,
            'name' => $otherSuperAdmin->name,
            'email' => $otherSuperAdmin->email,
            'username' => $otherSuperAdmin->username
        ];

        $this->assertDatabaseHas(User::class, $userData);
    }
}
