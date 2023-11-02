<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TicketsFormRequest extends FormRequest
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
            'userid' => 'string|min:1|nullable',
            'flowid' => 'string|min:1|nullable',
            'ticketid' => 'string|min:1|nullable',
            'last_message' => 'numeric|nullable',
            'current_node' => 'string|min:1|nullable',
            'contact_name' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable',
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
        $data = $this->only(['userid', 'flowid', 'ticketid', 'last_message', 'current_node', 'contact_name', 'status']);

        return $data;
    }

}