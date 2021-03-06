<?php

namespace App\Http\Requests;

use App\Rules\UniqueSlug;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'unique:articles,title', new UniqueSlug('articles')],
            'image.*' => ['mimes:png,jpg', 'image']
        ];
    }
}
