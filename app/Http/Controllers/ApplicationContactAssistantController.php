<?php

namespace App\Http\Controllers;

use App\Http\Integrations\OpenAIConnector;
use App\Http\Integrations\Requests\CreateChatRequest;
use App\Models\JobApplication;
use App\Models\User;
use App\Repositories\UserContextRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApplicationContactAssistantController extends Controller
{
    public function __construct(protected OpenAIConnector $openAIConnector) {}

    public function __invoke(Request $request, JobApplication $jobApplication)
    {
        Gate::authorize('isOwner', $jobApplication);

        $request->validate([
            'prompt' => ['required', 'string'],
        ]);

        $payload = $this->buildChatPayload(
            $request->user(),
            $jobApplication,
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
        JobApplication $jobApplication,
        string $prompt
    ): array {
        $userRepository = new UserContextRepository($user);
        $userContext = $userRepository->buildContext();

        $jobApplicationContext = [
            [
                'role' => 'system',
                'content' => 'I am going to give you context to a user as well as the job application and I want you to craft a message to the employer based on a prompt message given.',
            ],
            [
                'role' => 'system',
                'content' => $jobApplication->ai_context_string,
            ],
        ];

        return [
            ...$userContext,
            ...$jobApplicationContext,
            [
                'role' => 'user',
                'content' => $prompt,
            ],
        ];
    }
}
