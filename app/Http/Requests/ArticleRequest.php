<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\NotSpace;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => ['required', 'between:5,30', 'string', new NotSpace],
            'body' => ['required', 'between:30,1000', 'string', new NotSpace],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.between' => 'タイトルを5文字以上、30文字以下で入力してください',
            'body.required' => '本文を入力してください',
            'body.between' => '本文を30文字以上、1000文字以下で入力してください'
        ];
    }
}
