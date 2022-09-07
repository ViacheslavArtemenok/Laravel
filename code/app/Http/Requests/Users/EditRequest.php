<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:50'],
            'lastName' => ['required', 'string', 'min:2', 'max:50'],
            'phone' => ['required', 'string', 'min:10', 'max:21'],
            'email' => ['nullable', 'email', 'min:5'],
            'is_admin' => ['required'],

        ];
    }
    public function attributes(): array
    {
        return [
            'name' => '"Имя"',
            'lastName' => '"Фамилия"',
            'phone' => '"Телефон"',
            'email' => '"Электронная почта"',
            'is_admin' => '"Статус администратора"'
        ];
    }

    public function messages(): array
    {
        return [
            'min' => [
                'string'  => 'Поле :attribute должно быть не меньше :min символов.',
            ],
            'max' => [
                'string'  => 'Поле :attribute должно быть не больше :max символов.',
            ]
        ];
    }
}
