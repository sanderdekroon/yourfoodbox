<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if (Entrust::hasRole('admin')) { //admin can create and edit pages.
        //     return true;
        // }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            'is_published' => 'boolean'
        ];

        if ($this->method() == 'POST') {
            $rules['slug'] = 'unique:pages,slug';
        }

        return $rules;
    }
}
