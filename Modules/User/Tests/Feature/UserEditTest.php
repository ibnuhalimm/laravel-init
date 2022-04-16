<?php

namespace Modules\User\Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;

class UserEditTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @var \App\Models\User */
    private $adminUser;

    /**
     * Setup the test
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->createAdminRole();
        $this->adminUser = $this->createUser('Admin', [
            'username' => 'groot',
            'email' => 'groot@guardian.galaxy'
        ]);

        /** Another admin user */
        $this->createUser('Admin', [
            'username' => 'gamora',
            'email' => 'gamora@guardian.galaxy'
        ]);
    }

    /** @test */
    public function superadmin_can_see_edit_user_form_page()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $adminUser = $this->createUser('Admin');

        $this->get(route('user.edit', [ 'id' => $adminUser->id ]))
            ->assertStatus(Response::HTTP_OK)
            ->assertViewIs('user::edit')
            ->assertViewHas('user');
    }

    /** @test */
    public function admin_unable_to_see_create_user_form_page()
    {
        $this->actingAs($this->createUser('Admin'));

        $adminUser = $this->createUser('Admin');

        $this->get(route('user.edit', [ 'id' => $adminUser->id ]))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function superadmin_can_update_admin_data()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $adminUser = $this->createUser('Admin');

        $adminData = [
            'name' => $this->faker->name(),
            'username' => substr($this->faker->unique()->userName(), 0, 15),
            'email' => $this->faker->unique()->safeEmail(),
        ];

        $this->get(route('user.index'));
        $this->get(route('user.edit', [ 'id' => $adminUser->id ]));

        $this->post(route('user.update', [ 'user' => $adminUser ]), $adminData);

        $this->assertDatabaseHas(User::class, $adminData);
    }

    /** @test */
    public function admin_unable_to_update_admin_data()
    {
        $this->actingAs($this->createUser('Admin'));
        $this->createAdminRole();

        $adminUser = $this->createUser('Admin');

        $this->get(route('user.edit', [ 'id' => $adminUser->id ]));
        $this->post(route('user.update', [ 'user' => $adminUser ]))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function all_required_fields_on_update_request_are_validated()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $response = $this->post(route('user.update', [ 'user' => $this->adminUser ]), []);

        $response->assertSessionHasErrors([
            'name', 'username', 'email'
        ]);
    }

    /**
     * @dataProvider invalid_form_request
     * @test
     *
     * @param  array  $requestData
     * @param  array|string  $errorFields
     * @return void
     */
    public function update_request_should_fail(array $requestData, $errorFields)
    {
        $this->actingAs($this->createUser('Super Admin'));
        $this->createAdminRole();

        $this->post(route('user.update', [ 'user' => $this->adminUser ]), $requestData)
            ->assertSessionHasErrors($errorFields);
    }

    /**
     * The data provider for invalid form request
     *
     * @return array
     */
    public function invalid_form_request()
    {
        $faker = Factory::create();

        return [
            'No data provider' => [
                [
                    'name' => '',
                    'username' => '',
                    'email' => ''
                ],
                [
                    'name',
                    'username',
                    'email'
                ]
            ],
            'Name is not provided' => [
                [
                    'name' => '',
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => $faker->unique()->safeEmail()
                ],
                [
                    'name'
                ]
            ],
            'Name less than 3 characters' => [
                [
                    'name' => 'ab',
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => $faker->unique()->safeEmail()
                ],
                [
                    'name'
                ]
            ],
            'Name more than 30 characters' => [
                [
                    'name' => str_repeat('a', 31),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => $faker->unique()->safeEmail()
                ],
                [
                    'name'
                ]
            ],
            'Username is not provided' => [
                [
                    'name' => $faker->name(),
                    'username' => '',
                    'email' => $faker->unique()->safeEmail()
                ],
                [
                    'username'
                ]
            ],
            'Username less than 5 characters' => [
                [
                    'name' => $faker->name(),
                    'username' => str_repeat('a', 4),
                    'email' => $faker->unique()->safeEmail()
                ],
                [
                    'username'
                ]
            ],
            'Username more than 15 characters' => [
                [
                    'name' => $faker->name(),
                    'username' => str_repeat('a', 16),
                    'email' => $faker->unique()->safeEmail()
                ],
                [
                    'username'
                ]
            ],
            'Username contains whitespace characters' => [
                [
                    'name' => $faker->name(),
                    'username' => 'with space',
                    'email' => $faker->unique()->safeEmail()
                ],
                [
                    'username'
                ]
            ],
            'Username already used by others' => [
                [
                    'name' => $faker->name(),
                    'username' => 'gamora',
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password'
                ],
                [
                    'username'
                ]
            ],
            'Email not provided' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => ''
                ],
                [
                    'email'
                ]
            ],
            'Email is not valid' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => 'notanemail'
                ],
                [
                    'email'
                ]
            ],
            'Email already used by others' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => 'gamora@guardian.galaxy'
                ],
                [
                    'email'
                ]
            ],
            'Email more than 255 characters' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => str_repeat('a', 246) . '@email.com'
                ],
                [
                    'email'
                ]
            ],
        ];
    }
}
