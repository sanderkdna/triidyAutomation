<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UsersFormRequest extends FormRequest
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
            'name' => 'string|min:1|max:255|required',
            'email' => 'nullable|required',
            'password' => 'nullable',
            'token_code' => 'string|min:1|nullable',
            'commerse_code' => 'string|min:1|nullable',
            'shop_name' => 'string|min:1|nullable',
            'phone_number' => 'string|required',
            'whatsapp_token' => 'string|nullable',
            'tipo_usuario'  => 'string|required',
            'whatsapp_token'  => 'string|nullable',
            'url_wordpress'  => 'string|nullable',
            'url_api_shopify'  => 'string|nullable',
            'triidyPass' => 'string|nullable',
            'triidyUser' => 'string|nullable'
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
        $data = $this->only(['name', 'email', 'password', 'token_code', 'commerse_code', 'shop_name', 'phone_number', 'whatsapp_token','tipo_usuario','whatsapp_token','phone_number','url_wordpress','url_api_shopify', 'triidyPass', 'triidyUser']);


        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        
        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }

}
