<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DanhMucSanPhamRequest extends FormRequest
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
            'ten_danh_muc'            =>   'required|max:100|unique:danh_muc_san_phams,ten_danh_muc',
            'slug_danh_muc'           =>   'required|unique:danh_muc_san_phams,slug_danh_muc',
            // 'trang_thai'              =>   'required|boolean',
        ];
    }
}
