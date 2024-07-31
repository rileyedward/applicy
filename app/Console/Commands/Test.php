<?php

namespace App\Console\Commands;

use App\Http\Integrations\LlamaConnector;
use App\Http\Integrations\Requests\CreateChatRequest;
use Illuminate\Console\Command;

class Test extends Command
{
    protected $signature = 'app:test';

    protected $description = 'Used as a scratch pad for testing code.';

    public function handle(): void
    {
        /**
         * Llama API Implementation
         */
        try {
            $connector = new LlamaConnector();

            $request = new CreateChatRequest();

            $response = $connector->send($request);

            logger($response->body());
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
