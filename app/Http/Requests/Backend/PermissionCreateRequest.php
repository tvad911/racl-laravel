<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class PermissionCreateRequest extends Request
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
        $rules = array(
            'area'        => 'required|min:3|max:25',
            'permission'  => 'required|min:3|max:25|unique_with:acl_permissions,area',
            'actions'     => 'required|min:3|max:2048',
            'description' => 'max:255',
        );

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
