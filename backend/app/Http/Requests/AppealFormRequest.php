<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppealFormRequest extends FormRequest
{
    protected $redirectAction = false;
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
            'name' => 'required|max:255',
            'phone' => 'required|max:11',
            'content' => 'required|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'phone.required' => 'Номер телефона обязателен для заполнения',
            'content' => 'Заявка должна содержать текст обращения'
        ];
    }
}
