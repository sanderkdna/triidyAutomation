<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class FlowMessagesFormRequest extends FormRequest
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
        $rules = [
            'message' => 'numeric|nullable'
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
        $data = $this->only(['userid', 'flowid', 'message', 'node_parent', 'node_answer', 'end_pointid']);

        return $data;
    }

}
