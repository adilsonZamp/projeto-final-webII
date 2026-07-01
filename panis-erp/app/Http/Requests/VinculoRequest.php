<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VinculoRequest extends FormRequest
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
            "required.user_id" => "O preenchimento do usuário é obrigatório!",
            "required.loja_id" => "O preenchimento da loja é obrigatório!",
            "exists.user_id" => "Um usuário deve ser atribuído",
            "exists.loja_id" => "Uma loja deve ser selecionada",
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
            'loja_id' => "required|exists:loja,id",
            'user_id' => "required|exists:users,id",
        ];
    }
}
