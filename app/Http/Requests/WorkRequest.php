<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class WorkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
         
    // if (reqest()->isMethod(`post`)) {
    //     passwordRule = `required`;
    // }else (reqest()->isMethod(`put`)){
    //     passwordRule = `somtime`;

    // }


    {
        return [
            'name' => ['required','string'],
            // 'image' => ['required','image','mimes:jpeg,png,jpg,gif'],
            'is_active' => ['required','boolean'],

            'image' => [Rule::when(request()->isMethod(method:'POST'), rules: 'required'),
            Rule::when(request()->isMethod(method:'PUT'), rules: 'nullable')
            ],
            'description' => ['required', 'string'],
        ];
    }

    // protected function prepareForValidation()
    // {
    //     if ($this->image != null) {
    //         request()->remove(key: 'image');
    //     }
    // }


}

