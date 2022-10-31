<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCheckList extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'checklist_name' => 'required|min:4|max:4'
        ];
    }

    public function messages()
    {
        return [
            'checklist_name.required' => 'O nome do checklist é obrigatório',
            'checklist_name.min' => 'O nome do checklist é muito pequeno. Mínimo 4 caracteres',
            'checklist_name.max' => 'O nome do checklist é muito grande. Máximo 4 caracteres',
        ];
    }
}
