<?php

namespace App\Console\Commands;

use App\Http\Integrations\LlamaConnector;
use App\Http\Integrations\Requests\CreateChatRequest;
use App\Models\Application;
use App\Models\User;
use App\Services\ChatRequestService;
use Illuminate\Console\Command;

class Test extends Command
{
    protected $signature = 'app:test';

    protected $description = 'Used as a scratch pad for testing code.';

    public function handle(): void
    {
        $user = User::query()->where('id', 1)->first();
        $application = Application::query()->where('id', 1)->first();

        $chatRequestService = new ChatRequestService($user, $application);
        $payload = $chatRequestService->buildChatRequestPayload();

        try {
            $connector = new LlamaConnector;
            $request = new CreateChatRequest($payload);
            $response = $connector->send($request);

            $content = json_decode($response->body(), true);

            logger($content['choices'][0]['message']['content']);
        } catch (\Exception $e) {
            logger($e->getMessage());
        }
    }
}
