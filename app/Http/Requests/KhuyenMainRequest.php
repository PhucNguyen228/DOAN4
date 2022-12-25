<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhuyenMainRequest extends FormRequest
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
            'ten_dot_KM'        =>  'required|max:100',
            'ngay_bd'           =>  'required',
            'ngay_kt'           =>  'required',
            'trang_thai'        =>  'required|boolean',
        ];
    }
}
