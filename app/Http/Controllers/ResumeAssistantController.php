<?php

namespace App\Http\Controllers;

use App\Http\Integrations\OpenAIConnector;
use App\Http\Integrations\Requests\CreateChatRequest;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ResumeAssistantController extends Controller
{
    public function __construct(protected OpenAIConnector $openAIConnector) {}

    public function __invoke(Request $request, Resume $resume): JsonResponse
    {
        Gate::authorize('isOwner', $resume);

        if (app()->environment('local')) {
            sleep(2);
            return response()->json('This ia a test response');
        }

        $request->validate([
            'prompt' => ['required', 'string'],
        ]);

        $payload = $this->buildChatPayload(
            $request->user(),
            $resume,
            $request->input('prompt')
        );

        $request = new CreateChatRequest($payload);

        try {
            $response = $this->openAIConnector->send($request)->json();

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function buildChatPayload(
        User $user,
        Resume $resume,
        string $prompt
    ): array {
        return [
            [
                'role' => 'system',
                'content' => 'I am going to give you context to a user as well as the resume and I want you to make improvements to the resume based on a prompt message',
            ],
            [
                'role' => 'system',
                'content' => $user->buildAIContextString(),
            ],
            [
                'role' => 'system',
                'content' => $resume->buildAIContextString(),
            ],
            [
                'role' => 'user',
                'content' => $prompt,
            ],
        ];
    }
}
