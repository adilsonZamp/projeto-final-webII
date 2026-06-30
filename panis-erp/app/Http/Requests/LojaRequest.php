<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LojaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        // dd($this->array());
        $userLogado = Auth::user()->load(['perfil']);
        
        if ($userLogado->perfil->descricao == 'Dono') {
            $this->merge([
                'id_dono' => $userLogado->id,
            ]);
            // dd(['id_responsavel' => $this->id_responsavel,'id_perfil' => $this->id_perfil]);
        }
    }

    // public function withValidator($validator)
    // {
    //     //faz validação com lógica depois das Rules
    //     $validator->after(function ($validator) {});
    // }

    public function messages(): array {
        return [
            "required" => "O preenchimento do [:attribute] é obrigatório!",
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
            'nome' => "required|max:100|min:4",
            'id_dono' => "required|exists:users,id",
        ];
    }
}
