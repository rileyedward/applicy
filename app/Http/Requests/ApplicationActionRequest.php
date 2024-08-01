<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationActionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:applied,in_review,coding_challenge,interview_scheduled,interviewed,offer_extended,offer_accepted,offer_declined,rejected,withdrawn'],
            'title' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'interview_date' => ['nullable', 'date'],
            'interview_time' => ['nullable', 'date_format:H:i'],
        ];
    }
}
