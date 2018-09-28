<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveWebsiteBooking extends FormRequest
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
            'id' => 'numeric|nullable',
            'first' => 'required|max:25',
            'last' => 'required|max:25',
            'phone' => 'required|max:14',
            'email' => 'required|email',
            'user_id' => 'numeric|nullable',
            'tattoo_size' => 'required|max:65',
            'description' => 'required|max:255',
            'location' => 'required|max:65',
            'color_preference' => 'required|max:25',
            'tattoo_style' => 'required|max:45',
            'budget' => 'required|max:25',
            'images.*' => 'base64image|nullable',
            'captcha' => 'required'
        ];
    }
}
