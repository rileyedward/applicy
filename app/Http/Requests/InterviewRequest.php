<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'interview_date' => ['required', 'date'],
            'interview_time' => ['required'],
            'interview_url' => ['nullable', 'url'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
