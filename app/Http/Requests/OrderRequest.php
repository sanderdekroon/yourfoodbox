<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Product;

class OrderRequest extends Request
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
        $rules = [
            'product_id' => 'required|exists:products,id,week_no,'.date('W'),
            'amount' => 'required'
        ];

        return $rules;
    }
}
