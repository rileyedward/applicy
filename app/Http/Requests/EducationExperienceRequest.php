<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationExperienceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'institution_name' => ['required', 'string'],
            'location' => ['required', 'string'],
            'degree' => ['required', 'string'],
            'field_of_study' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'description' => ['nullable', 'string'],
        ];
    }
}
