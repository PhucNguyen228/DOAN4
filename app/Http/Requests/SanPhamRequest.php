<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanPhamRequest extends FormRequest
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
                'ten_san_pham'            =>   'required|max:100',
                'slug_san_pham'           =>   'required',
                'gia_ban'                 =>    'required|numeric|min:1',
                'don_vi'                  =>    'required',
                'anh_dai_dien'            =>    'required',
                'id_danh_muc'             =>    'required|exists:danh_muc_san_phams,id',
                'mo_ta_ngan'              =>    'required',
                'mo_ta_dai'               =>    'required',
                'is_open'                 =>    'required|boolean',
        ];
    }
}
