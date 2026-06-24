<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array {
        return [
            "required" => "O preenchimento deste campo é obrigatório!",
            "exists" => "O tipo deve ser válido",
            "max" => "O tamanho máximo é [:max] caracteres",
            "min" => "O tamanho mínimo é [:min] caracteres",
            "email" => "Digite um email válido",
            "not_in" => "nice try :D",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => "required|max:100|min:4",
            'email' => "required|max:255|email",
            'password' => "required",
            'id_perfil' => "required|exists:perfil,id_perfil|not_in:0",
        ];
    }
}
