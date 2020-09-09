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
            'video_id' => 'string|min:11|max:55',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'クリップタイトル',
            'video_id' => 'Youtube VIDEO_ID',
            'tags' => 'タグ'
        ];
    }

    // タグをJson形式からコレクションに
    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
        ->slice(0,3)
        ->map(function($requestTag) {
            return $requestTag ->text;
        });
    }
}
