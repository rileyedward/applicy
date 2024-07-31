<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationActionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:applied,in_review,coding_challenge,interview_scheduled,interviewed,offer_extended,offer_accepted,offer_declined,rejected,withdrawn'],
            'notes' => ['required', 'string'],
        ];
    }
}
