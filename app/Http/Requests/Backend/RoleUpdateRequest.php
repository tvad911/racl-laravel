<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class RoleUpdateRequest extends Request
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
            'name'   => 'required|min:3|max:255|unique:acl_roles,name',
            'filter' => 'in:A,D,R',
        );

        $input = Request::only('id');
        if($input['id']) {
            $rules['name']    .= ','. $input['id'] .' = id';
        }

        return $rules;
    }
}
