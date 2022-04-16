<?php

namespace Modules\User\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;

class UserIndexTest extends TestCase
{
    /**
     * Make request format for datatable
     *
     * @param  string|null  $searchingKeyword
     * @return array
     */
    private function datatableRequestParams($searchingKeyword = null)
    {
        return [
            'draw' => 1,
            'columns' => [
                [
                    'data' => 'DT_RowIndex',
                    'name' => 'DT_RowIndex',
                    'searchable' => false,
                    'orderable' => false
                ],
                [
                    'data' => 'name',
                    'name' => 'name',
                    'searchable' => true,
                    'orderable' => true
                ],
                [
                    'data' => 'username',
                    'name' => 'username',
                    'searchable' => true,
                    'orderable' => true
                ],
                [
                    'data' => 'email',
                    'name' => 'email',
                    'searchable' => true,
                    'orderable' => true
                ],
                [
                    'data' => 'email',
                    'name' => null,
                    'searchable' => true,
                    'orderable' => true
                ],
                [
                    'data' => 'role_name',
                    'name' => 'role_name',
                    'searchable' => false,
                    'orderable' => false
                ],
                [
                    'data' => 'action',
                    'name' => null,
                    'searchable' => false,
                    'orderable' => false
                ],
            ],
            'order' => [
                [
                    'column' => 1,
                    'dir' => 'asc'
                ]
            ],
            'start' => 0,
            'length' => 10,
            'search' => [
                'value' => $searchingKeyword
            ]
        ];
    }

    /** @test */
    public function superadmin_can_see_user_datatable_page()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $this->get(route('user.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertViewIs('user::index');

        $this->getJson(route('user.datatable', $this->datatableRequestParams()))
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function admin_unable_to_see_user_datatable_page()
    {
        $this->actingAs($this->createUser('Admin'));

        $this->get(route('user.index'))
             ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->getJson(route('user.datatable', $this->datatableRequestParams()))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function user_datatable_route_should_respond_correct_json_format()
    {
        $this->actingAs($this->createUser('Super Admin'));

        $this->getJson(route('user.datatable', $this->datatableRequestParams()))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->has('data.0', function (AssertableJson $json) {
                        $json
                            ->has('DT_RowIndex')
                            ->has('id')
                            ->has('name')
                            ->has('username')
                            ->has('email')
                            ->has('role_name')
                            ->has('action')
                            ->etc();
                    })
                    ->has('recordsFiltered')
                    ->has('recordsTotal')
                    ->etc();
            });
    }

    /** @test */
    public function user_datatable_searching_should_working_properly()
    {
        $this->actingAs($this->createUser('Super Admin'));

        User::factory()
            ->sequence(
                [ 'name' => 'Iron Man' ],
                [ 'name' => 'Iron Spider' ],
                [ 'name' => 'Ant Man' ]
            )
            ->create();

        $searchKeyword = 'Iron';

        $this->getJson(route('user.datatable', $this->datatableRequestParams($searchKeyword)))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->has('data', 2)
                    ->has('data.0', function (AssertableJson $json) {
                        $json
                            ->has('DT_RowIndex')
                            ->has('id')
                            ->has('name')
                            ->has('username')
                            ->has('email')
                            ->has('role_name')
                            ->has('action')
                            ->etc();
                    })
                    ->has('recordsFiltered')
                    ->has('recordsTotal')
                    ->etc();
            });
    }
}
