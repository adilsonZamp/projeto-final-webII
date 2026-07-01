<?php

namespace App\Http\Requests;

use App\Services\UsuarioService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        
        if ($this->id_perfil == 2 && $this->id_responsavel == null) {
            $idUserLogado = auth()->id();
            $this->merge([
                'id_responsavel' => $idUserLogado,
            ]);
            // dd(['id_responsavel' => $this->id_responsavel,'id_perfil' => $this->id_perfil]);
        }
    }

    public function withValidator($validator)
    {
        //faz validação com lógica depois das Rules
        $validator->after(function ($validator) {
            $usuarioService = app(UsuarioService::class);

            // dd([$this->id_perfil, $this->id_responsavel]);

            $perfil = $this->id_perfil;
            $responsavel = $this->id_responsavel;

            if ($perfil == 2) {
                // dd($responsavel);
                if (!$usuarioService->validarHierarquiaGerente($responsavel)) {
                    $validator->errors()->add(
                        'id_responsavel',
                        'Gerentes precisam ter um dono responsável.'
                    );
                }
            } else if ($perfil == 3) {
                if (!$usuarioService->validarHierarquiaFuncionario($responsavel)) {
                    $validator->errors()->add(
                        'id_responsavel',
                        'Funcionários precisam ter um gerente responsável.'
                    );
                }
            }
        });
    }

    public function messages(): array {
        return [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "email.unique" => "Esse email já está em uso, por favor escolha outro.",
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
        if ($this->isMethod('PUT')) {
            return [
                'name' => "required|max:100|min:4",
                'email' => "required|max:255|email",
                'id_perfil' => "required|exists:perfil,id|not_in:0",
                'id_responsavel' => [
                    'nullable',
                    'required_if:id_perfil,2,3',
                    'exists:users,id'
                ],
            ];
        } else {
            return [
                'name' => "required|max:100|min:4",
                'email' => ['required', 'max:255', 'email', Rule::unique('users', 'email')->ignore($this->route('id'))],
                'password' => "required",
                'id_perfil' => "required|exists:perfil,id|not_in:0",
                'id_responsavel' => [
                    'nullable',
                    'required_if:id_perfil,2,3',
                    'exists:users,id'
                ],
            ];
        }
    }
}
