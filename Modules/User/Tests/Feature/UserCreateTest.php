<?php

namespace Modules\User\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;

class UserCreateTest extends TestCase
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

        $this->createUser('Admin', [
            'username' => 'groot',
            'email' => 'groot@guardian.galaxy'
        ]);
    }

    /** @test */
    public function superadmin_can_see_create_user_form_page()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $this->get(route('user.create'))
            ->assertStatus(Response::HTTP_OK)
            ->assertViewIs('user::create');
    }

    /** @test */
    public function admin_unable_to_see_create_user_form_page()
    {
        $this->actingAs($this->createUser('Admin'));

        $this->get(route('user.create'))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function superadmin_can_create_new_admin()
    {
        $this->actingAs($this->createUser('Super Admin'));
        $this->createAdminRole();

        $adminData = [
            'name' => $this->faker->name(),
            'username' => substr($this->faker->unique()->userName(), 0, 15),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password'
        ];

        $this->get(route('user.index'));
        $this->post(route('user.store'), $adminData)
             ->assertRedirect(route('user.index'));
    }

    /** @test */
    public function admin_unable_to_create_new_admin()
    {
        $this->actingAs($this->createUser('Admin'));
        $this->createAdminRole();

        $this->get(route('user.index'));
        $this->post(route('user.store'))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function all_required_fields_on_store_request_are_validated()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $response = $this->post(route('user.store'), []);

        $response->assertSessionHasErrors([
            'name', 'username', 'email', 'password'
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
    public function store_request_should_fail(array $requestData, $errorFields)
    {
        $this->actingAs($this->createUser('Super Admin'));
        $this->createAdminRole();

        $this->post(route('user.store'), $requestData)
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
                    'email' => '',
                    'password' => ''
                ],
                [
                    'name',
                    'username',
                    'email',
                    'password'
                ]
            ],
            'Name is not provided' => [
                [
                    'name' => '',
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password'
                ],
                [
                    'name'
                ]
            ],
            'Name less than 3 characters' => [
                [
                    'name' => 'ab',
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password'
                ],
                [
                    'name'
                ]
            ],
            'Name more than 30 characters' => [
                [
                    'name' => str_repeat('a', 31),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password'
                ],
                [
                    'name'
                ]
            ],
            'Username is not provided' => [
                [
                    'name' => $faker->name(),
                    'username' => '',
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password'
                ],
                [
                    'username'
                ]
            ],
            'Username less than 5 characters' => [
                [
                    'name' => $faker->name(),
                    'username' => str_repeat('a', 4),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password'
                ],
                [
                    'username'
                ]
            ],
            'Username more than 15 characters' => [
                [
                    'name' => $faker->name(),
                    'username' => str_repeat('a', 16),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password'
                ],
                [
                    'username'
                ]
            ],
            'Username contains whitespace characters' => [
                [
                    'name' => $faker->name(),
                    'username' => 'with space',
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'password'
                ],
                [
                    'username'
                ]
            ],
            'Username already exists' => [
                [
                    'name' => $faker->name(),
                    'username' => 'groot',
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
                    'email' => '',
                    'password' => 'password'
                ],
                [
                    'email'
                ]
            ],
            'Email is not valid' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => 'notanemail',
                    'password' => 'password'
                ],
                [
                    'email'
                ]
            ],
            'Email already exists' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => 'groot@guardian.galaxy',
                    'password' => 'password'
                ],
                [
                    'email'
                ]
            ],
            'Email more than 255 characters' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => str_repeat('a', 246) . '@email.com',
                    'password' => 'password'
                ],
                [
                    'email'
                ]
            ],
            'Password is not provided' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => ''
                ],
                [
                    'password'
                ]
            ],
            'Password less than 8 characters' => [
                [
                    'name' => $faker->name(),
                    'username' => substr($faker->unique()->userName(), 0, 15),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => '1234567'
                ],
                [
                    'password'
                ]
            ],
        ];
    }
}
