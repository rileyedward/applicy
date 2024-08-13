<?php

namespace App\Http\Controllers;

use App\Http\Integrations\OpenAIConnector;
use App\Http\Integrations\Requests\CreateChatRequest;
use App\Models\User;
use App\Repositories\UserContextRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewCoverLetterController extends Controller
{
    public function __construct(protected OpenAIConnector $openAIConnector) {}

    public function __invoke(Request $request): JsonResponse
    {
        $payload = $this->buildChatPayload($request->user());

        $request = new CreateChatRequest($payload);

        try {
            $response = $this->openAIConnector->send($request);
            $json = $response->json();

            return response()->json($json['choices'][0]['message']['content']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function buildChatPayload(User $user): array
    {
        $userRepository = new UserContextRepository($user);
        $userContext = $userRepository->buildContext();

        $context = [
            [
                'role' => 'system',
                'content' => 'I am going to give you the full context of a user with all of their professional and educational experiences, along with some personal projects of theirs. With that I want you to generate a new cover letter that I can use as a template for future job applications.',
            ],
        ];

        return [
            ...$context,
            ...$userContext,
        ];
    }
}
