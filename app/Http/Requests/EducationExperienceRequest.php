<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationExperienceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'degree' => ['required', 'string'],
            'field_of_study' => ['required', 'string'],
            'institution_name' => ['required', 'string'],
            'location' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
        ];
    }
}
