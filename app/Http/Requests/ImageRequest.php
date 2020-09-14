<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'profile_image' => 'required|file|image|mimes:jpeg,png'
        ];
    }

    public function attributes()
    {
        return [
            'profile_image' => 'プロフィール画像',
        ];
    }
}
