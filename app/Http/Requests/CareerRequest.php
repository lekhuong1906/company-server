<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
{
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
            'department_id' => 'required|integer',
            'name' => 'required',
            'amount' => 'required|integer',
            'level' => 'required|integer',
            'description' => 'required',
            'requirements' => 'required',
            'salary_min' => 'required',
            'salary_max' => 'required',
            'end_date' => 'required'
        ];
    }
}
