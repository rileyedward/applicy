<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'url' => ['nullable', 'url'],
            'description' => ['nullable', 'string'],
        ];
    }
}
