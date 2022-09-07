<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
            'status' => ['required', 'string', 'min:5', 'max:7'],
            'image'  => ['nullable', 'url'],
            'description' => ['nullable', 'string'],
            'link'  => ['nullable', 'url'],
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => '"Категория новостей"',
            'title' => '"Заголовок"',
            'author_id' => '"Автор"',
            'status' => '"Статус"',
            'image'  => '"URL изображения"',
            'description' => '"Описание"',
            'link'  => '"URL источника"',
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
