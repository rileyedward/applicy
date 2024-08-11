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

    public function __construct(protected array $messages) {}

    public function resolveEndpoint(): string
    {
        return '/chat/completions';
    }

    protected function defaultBody(): array
    {
        return [
            'model' => 'gpt-4o-mini-2024-07-18',
            'messages' => $this->messages,
        ];
    }
}
