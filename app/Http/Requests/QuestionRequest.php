<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'description' => ['required'],
            'test_id' => ['required', 'numeric', 'exists:tests,id']
        ];
    }

    public function messages() {
        return [
            'description.required' => 'Savolni kiritilmadi.',
            'test_id.required' => 'Test topilmadi.',
            'test_id.exists' => 'Bunday test mavjud emas.'
        ];
    }

}
