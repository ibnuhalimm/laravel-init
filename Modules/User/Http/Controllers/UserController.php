<?php

namespace Modules\User\Http\Controllers;

use App\Http\Requests\DatatableRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Actions\DeleteUser;
use Modules\User\Actions\StoreUser;
use Modules\User\Actions\FindUser;
use Modules\User\Actions\UpdateUser;
use Modules\User\Http\Requests\UserStoreRequest;
use Modules\User\Http\Requests\UserUpdateRequest;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Server-side datatable of the users data
     *
     * @param  \App\Http\Requests\DatatableRequest  $request
     * @return mixed
     */
    public function datatable(DatatableRequest $request)
    {
        $search = isset($request->get('search')['value'])
            ? $request->get('search')['value']
            : null;

        $orderColumnList = [
            'id', 'name', 'username', 'email'
        ];

        $orderColumnIndex = isset($request->get('order')[0]['column'])
            ? $request->get('order')[0]['column']
            : 0;

        $orderColumnDir = isset($request->get('order')[0]['dir'])
            ? $request->get('order')[0]['dir']
            : 'desc';

        $orderColumnName = $orderColumnList[$orderColumnIndex] ?? 'id';

        $users = User::query()
            ->with('roles')
            ->orderBy($orderColumnName, $orderColumnDir);

        return DataTables::of($users)
            ->addColumn('name', function ($user) {
                if ($user->id == auth()->user()->id) {
                    return '<span class="font-bold italic">' . $user->name . ' (You)</span>';
                }

                return $user->name;
            })
            ->addColumn('role_name', function ($user) {
                return $user->roles()->first()->name ?? '';
            })
            ->addColumn('action', function ($user) {
                if ($user->id == auth()->user()->id) {
                    return;
                }

                return '
                    <a href="'. route('user.edit', [ 'id' => $user->id ]) .'" class="btn-action--green">
                        Edit
                    </a>
                    <button type="button" class="btn-action--red"
                        data-id="'. $user->id .'"
                        data-name="'. $user->name .'"
                        onClick="deleteUser(this)">
                        Hapus
                    </button>
                ';
            })
            ->rawColumns(['name', 'role_name', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in database.
     * @param  UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $requestData = $request->validated();

        $userData = [
            'name' => $requestData['name'],
            'username' => $requestData['username'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
        ];

        StoreUser::make()->handle($userData);

        return redirect()->route('user.index')->with('success', 'User berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $user = FindUser::make()->handle($id);

        return view('user::edit', compact('user'));
    }

    /**
     * Update the specified resource in database.
     * @param  User $user
     * @param  UserUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        $requestData = $request->validated();

        $userData = [
            'name' => $requestData['name'],
            'username' => $requestData['username'],
            'email' => $requestData['email']
        ];

        UpdateUser::make()->handle($user->id, $userData);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from database.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DeleteUser::make()->handle($id);

        return $this->apiResponse(Response::HTTP_OK, 'User berhasil dihapus');
    }
}
