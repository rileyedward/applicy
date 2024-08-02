<?php

namespace App\Console\Commands;

use App\Http\Integrations\OpenAI\OpenAIConnector;
use App\Http\Integrations\OpenAI\Requests\CreateChatRequest;
use App\Models\Application;
use App\Models\User;
use App\Services\ChatRequestService;
use Illuminate\Console\Command;

class Test extends Command
{
    protected $signature = 'app:test';

    public function handle(): void
    {
        /**
         * This code below grabs a user and an application submitted by the user.
         * Using those values and the ChatRequestService class, we can build out
         * the messages payload required for the Llama API to create a chat request.
         * Using that built payload, we can utilize the Llama Connector to send the
         * request to the Llama API and log the response.
         */
        $user = User::query()->where('id', 1)->first();
        $application = Application::query()->where('id', 1)->first();

        $chatRequestService = new ChatRequestService($user, $application);
        $payload = $chatRequestService->buildChatRequestPayload();

        try {
            $connector = new OpenAIConnector;
            $request = new CreateChatRequest($payload);
            $response = $connector->send($request);

            $content = json_decode($response->body(), true);

            logger($content['choices'][0]['message']['content']);
        } catch (\Exception $e) {
            logger($e->getMessage());
        }
    }
}
