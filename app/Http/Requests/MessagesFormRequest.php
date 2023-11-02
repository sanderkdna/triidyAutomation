<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MessagesFormRequest extends FormRequest
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
            'ticketid' => 'string|min:1|nullable',
            'contact_name' => 'string|min:1|nullable',
            'message' => 'numeric|nullable',
            'node' => 'string|min:1|nullable',
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
        $data = $this->only(['ticketid', 'contact_name', 'message', 'node']);

        return $data;
    }

}