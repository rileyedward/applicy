<?php

namespace App\Http\Integrations;

use Saloon\Http\Connector;

class OpenAIConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return config('services.openai.url');
    }

    public function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . config('services.openai.key'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
