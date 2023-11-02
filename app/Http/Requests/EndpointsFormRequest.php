<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EndpointsFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'userId' => 'string|min:1|nullable',
            'title' => 'string|min:1|max:255|nullable',
            'url' => 'string|min:1|nullable',
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['userId', 'title', 'url']);

        return $data;
    }

}