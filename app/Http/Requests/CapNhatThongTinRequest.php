<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatThongTinRequest extends FormRequest
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
            'ten_tai_khoan'     =>  'required|min:4|max:50',
            'email'             =>  'required|email|unique:tai_khoans,email,' .$this->id,
            'sdt'               =>  'required|digits:10|unique:tai_khoans,sdt,' .$this->id,
            'id'                =>  'required|exists:tai_khoans,id',
        ];
    }
}
