<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuanLyThueRequest extends FormRequest
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
            'Ten_thue'            =>   'required|max:255' . $this->id,
            'Muc_thue'           =>   'required|numeric|min:0' . $this->id,
            // 'trang_thai'              =>   'required|boolean',
            'id'                      =>   'required|exists:quan_ly_thue_admins,id',
        ];
    }
}
