<?php

namespace App\Http\Controllers;

use App\Http\Integrations\OpenAIConnector;
use App\Http\Integrations\Requests\CreateChatRequest;
use App\Models\CoverLetterTemplate;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CoverLetterAssistantController extends Controller
{
    public function __construct(protected OpenAIConnector $openAIConnector) {}

    public function __invoke(Request $request, CoverLetterTemplate $coverLetterTemplate): JsonResponse
    {
        Gate::authorize('isOwner', $coverLetterTemplate);

        if (app()->environment('local')) {
            sleep(2);

            return response()->json('This ia a test response');
        }

        $request->validate([
            'prompt' => ['required', 'string'],
        ]);

        $payload = $this->buildChatPayload(
            $request->user(),
            $coverLetterTemplate,
            $request->input('prompt')
        );

        $request = new CreateChatRequest($payload);

        try {
            $response = $this->openAIConnector->send($request);
            $json = $response->json();

            return response()->json($json['choices'][0]['message']['content']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function buildChatPayload(
        User $user,
        CoverLetterTemplate $coverLetterTemplate,
        string $prompt
    ): array {
        return [
            [
                'role' => 'system',
                'content' => 'I am going to give you context to a user as well as the cover letter and I want you to make improvements to the cover letter based on a prompt message',
            ],
            [
                'role' => 'system',
                'content' => $coverLetterTemplate->buildAIContextString(),
            ],
            [
                'role' => 'system',
                'content' => $user->buildAIContextString(),
            ],
            [
                'role' => 'user',
                'content' => $prompt,
            ],
        ];
    }
}
