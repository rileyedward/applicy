<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationActionRequest extends FormRequest
{
    public function rules(): array
    {
        $statusEnums = array_map(fn ($status) => $status['value'], config('applications.statuses'));

        return [
            'title' => ['required', 'string'],
            'new_status' => ['required', 'string', 'in:'.implode(',', $statusEnums)],
            'interview_date' => ['required_if:new_status,interview_scheduled', 'date'],
            'interview_time' => ['required_if:new_status,interview_scheduled', 'date_format:H:i'],
            'interview_url' => ['nullable', 'url'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'interview_date.required_if' => 'What day is the interview scheduled for?',
            'interview_time.required_if' => 'What time is the interview scheduled for?',
        ];
    }
}
