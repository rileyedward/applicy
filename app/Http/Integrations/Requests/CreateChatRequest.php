<?php

namespace App\Http\Integrations\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateChatRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/completions';
    }

    protected function defaultBody(): array
    {
        return [
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Hello, how can I help you today?'
                ]
            ]
        ];
    }
}
