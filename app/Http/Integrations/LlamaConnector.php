<?php

namespace App\Http\Integrations;

use Saloon\Http\Connector;

class LlamaConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://api.llama-api.com/chat';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . config('services.llama.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
