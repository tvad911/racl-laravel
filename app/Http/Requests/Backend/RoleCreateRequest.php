<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class RoleCreateRequest extends Request
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
            'name'   => 'required|min:3|max:255|unique:acl_roles,name',
            'filter' => 'in:A,D,R',
        ];
    }
}
