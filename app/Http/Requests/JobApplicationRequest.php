<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        $environmentEnums = array_map(fn ($env) => $env['value'], config('applications.environments'));
        $statusEnums = array_map(fn ($status) => $status['value'], config('applications.statuses'));

        return [
            'job_url' => ['nullable', 'url'],
            'company_url' => ['nullable', 'url'],
            'position' => ['required', 'string'],
            'company_name' => ['required', 'string'],
            'location' => ['required', 'string'],
            'environment' => ['required', 'string', 'in:'.implode(',', $environmentEnums)],
            'salary_range' => ['nullable', 'string'],
            'contact_name' => ['nullable', 'string'],
            'contact_email' => ['nullable', 'email'],
            'contact_phone' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:'.implode(',', $statusEnums)],
        ];
    }
}
