<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'introduction' => ['nullable', 'max:200'],
            'url' => ['nullable', 'url', 'max:2000'],
        ];
    }

    public function messages()
    {
        return [
            'introduction.max' => '200文字以内で入力してください',
            'url.url' => '有効なURLではありません',
            'url.max' => '2000文字以内で入力して下さい',
        ];
    }
}
