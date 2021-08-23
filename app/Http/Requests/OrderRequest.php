<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $rules = [];

        if (empty($this->user())) {
            $rules['number']='required|min:4|max:255';
        }
        if ($this->filled('email')) {
            $rules['email']='email';
        }
        if ($this->filled('name')) {
            $rules['name']='min:3|max:255';
        }
        if (!$this->filled('product_id')) {
            $rules['title']='required|min:3|max:255';
            $rules['desc']='required|min:3';
        }
        if (!$this->filled('title') && !$this->filled('desc')) {
            $rules['product_id']='required|integer';
        }

        return $rules;
    }
}
