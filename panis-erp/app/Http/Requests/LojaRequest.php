<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LojaRequest extends FormRequest
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
            "exists" => "Um dono deve ser atribuído",
            "max" => "O tamanho máximo é [:max] caracteres",
            "min" => "O tamanho mínimo é [:min] caracteres",
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
            'password' => "required",
            'id_dono' => "required|exists:users,id",
        ];
    }
}
