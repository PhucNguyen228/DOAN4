<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChiTietKhuyenMaiRequest extends FormRequest
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
            'id_khuyen_mai'           =>   'required|exists:khuyen_mais,id',
            'id_san_pham'             =>   'required|exists:san_phams,id',
            'ti_le_KM'                =>   'required|numeric',
            'trang_thai'              =>   'required|boolean',
            'id'                      =>   'required|exists:chi_tiet_khuyen_mais,id',
        ];
    }
}
