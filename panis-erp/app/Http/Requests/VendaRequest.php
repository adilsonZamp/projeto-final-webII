<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VendaRequest extends FormRequest
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
            "required" => "O preenchimento do [:attribute] é obrigatório!",
            "exists" => "Uma loja deve ser atribuída",
            "date" => "Uma data válida é necessária",
            "decimal" => "O máximo de casas decimais é [:decimal]",
            "min" => "O valor mínimo é [:min]",
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
            'valor' => 'required|numeric|decimal:0,2|min:0',
            'id_loja' => 'required|exists:loja,id',
            'data_referencia' => 'required|date',
        ];
    }
}
/*
<!-- 'valor' => 1500,
'id_loja' => 1,
'data_referencia' => '30-06-2026', -->
*/