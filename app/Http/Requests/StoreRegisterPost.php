<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegisterPost extends FormRequest
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
        return ['email'=>[
                'required',
                Rule::unique('register')->ignore(request()->id,'register_id'),
            ],
            ];
    }

    public function messages(){
        return [
            'email.required'=>'邮箱或手机号必填',
        ];
    }
}
