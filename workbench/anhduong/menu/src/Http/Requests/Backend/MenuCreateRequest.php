<?php
namespace Anhduong\Menu\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class MenuCreateRequest extends FormRequest
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
            'title'  => 'required|min:3|max:255',
            'slug'   => 'required|min:3|max:255|unique:menus,slug',
            'status' => 'required|integer|in:0,1',
        );

        return $rules;
    }
}
