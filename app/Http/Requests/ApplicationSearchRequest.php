<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationSearchRequest extends FormRequest
{
    public function rules(): array
    {
        $environmentEnums = array_map(fn ($env) => $env['value'], config('applications.environments'));
        $statusEnums = array_map(fn ($status) => $status['value'], config('applications.statuses'));

        return [
            'environments' => ['array', 'in:'.implode(',', $environmentEnums)],
            'statuses' => ['array', 'in:'.implode(',', $statusEnums)],
            'locations' => ['array'],
        ];
    }
}
