<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => [
                'string',
                'required',
            ],
            'password'  => [
                'string',
                'required',
            ],
            'email' => [
                'unique:users',
                'required',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'array',
                'required',
            ],
            'image'    => [
                'image',
                'required',
            ],
        ];
    }
}
