<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rut' => 'required',
            'grado'=>'required',
            'nombres' => 'required',
            'apellidoPaterno'=> 'required',
            'apellidoMaterno'=> 'required',
            'institucion_id'=> 'required',
            'organizacion_id'=> 'required',
            'email'=> 'required',
            'password'=> 'required',
            'roles' =>'required'
        ];
    }
}
