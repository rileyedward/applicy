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
            'notes' => ['nullable', 'string'],
        ];
    }
}
