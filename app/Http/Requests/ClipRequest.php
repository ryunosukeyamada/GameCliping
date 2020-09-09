<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClipRequest extends FormRequest
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
            'title' => 'required|max:30',
            'video_id' => 'min:11|max:55',
        ];
    }
    public function attributes()
    {
        return[
            'title' => 'クリップタイトル',
            'video_id' => 'Youtube VIDEO_ID',
        ];
    }

}
