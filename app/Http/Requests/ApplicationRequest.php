<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'job_url' => ['nullable', 'url'],
            'status' => ['nullable', 'string', 'in:need_to_apply,applied,in_review,coding_challenge,interview_scheduled,interviewed,offer_extended,offer_accepted,offer_declined,rejected,withdrawn'],
            'position' => ['required', 'string'],
            'company_name' => ['required', 'string'],
            'location' => ['required', 'string'],
            'environment' => ['required', 'string', 'in:remote,on-site,hybrid'],
            'description' => ['nullable', 'string'],
            'contact_name' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
        ];
    }
}
