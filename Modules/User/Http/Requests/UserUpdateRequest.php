<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UserUpdateRequest extends FormRequest
{
    /** @var int */
    private $userId;

    /**
     * Create new instance
     *
     * @return void
     */
    public function __construct()
    {
        $user = Route::current()->parameter('user');
        $this->userId = $user->id ?? 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'name' => [
                'required', 'min:3', 'max:30'
            ],
           'username' => [
                'required', 'unique:users,username,' . $this->userId, 'alpha_dash', 'min:5', 'max:15'
            ],
            'email' => [
                'required', 'unique:users,email,' . $this->userId, 'email', 'max:255'
            ]
        ];
    }

    /**
     * Get the validation attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'username' => 'Username',
            'email' => 'Email',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
