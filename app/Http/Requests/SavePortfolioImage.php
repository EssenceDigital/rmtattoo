<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePortfolioImage extends FormRequest
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
            'portfolio_artist_id' => 'required|integer',
            'description' => 'string|max:30|nullable',
            'src' => 'base64image'
        ];
    }
}
