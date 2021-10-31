<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'start_date' => ['required', 'date_format:Y-m-d\TH:i'],
            'end_date' => ['required','after_or_equal:start_date', 'date_format:Y-m-d\TH:i']
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Test nomini kiriting.',
            'start_date.date_format' => 'Boshlanish vaqti formati noto\'g\'ri kiritildi.',
            'end_date.date_format' => 'Tugash vaqti formati noto\'g\'ri kiritildi.',
            'start_date.
            required' => 'Boshlanish vaqtini kiriting.',
            'end_date.required' => 'Tugash vaqtini kiriting.',
        ];
    }
}
