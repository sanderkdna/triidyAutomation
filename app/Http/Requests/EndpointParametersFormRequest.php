<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EndpointParametersFormRequest extends FormRequest
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
            'endpointId' => 'string|min:1|nullable',
            'parameter' => 'string|min:1|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'userId' => 'string|min:1|nullable',
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
        $data = $this->only(['endpointId', 'parameter', 'description', 'userId']);

        return $data;
    }

}