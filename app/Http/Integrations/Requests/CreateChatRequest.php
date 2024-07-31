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
                    'content' => 'Hello! I will provide you with detailed information about a user on this platform, including their personal details, education, work experience, and portfolio projects. Additionally, I will include a brief description of a job they intend to apply for. Based on this information, please write a cover letter for the user.',
                ]
            ],
        ];
    }
}
