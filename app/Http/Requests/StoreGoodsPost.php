<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsPost extends FormRequest
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
            //
        ];
    }

    public function messages(){
        return [
            'goods_name.required'=>'商品名称必填',
            'gods_name.unique'=>'商品名称已存在',
            'goods_price.required'=>'商品价格必填',
            'goods_num.required'=>'商品库存必填'
        ];
    }
}
