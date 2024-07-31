<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'job_url' => ['required', 'url'],
            'position' => ['required', 'string'],
            'company_name' => ['required', 'string'],
            'location' => ['required', 'string'],
            'environment' => ['required', 'string', 'in:remote,on-site,hybrid'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string', 'in:applied,in_review,coding_challenge,interview_scheduled,interviewed,offer_extended,offer_accepted,offer_declined,rejected,withdrawn'],
            'submission_date' => ['required', 'date']
        ];
    }
}
