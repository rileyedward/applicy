<?php

namespace App\Http\Controllers;

use App\Http\Integrations\OpenAIConnector;
use App\Http\Integrations\Requests\CreateChatRequest;
use App\Models\CoverLetterTemplate;
use App\Models\JobApplication;
use App\Models\User;
use App\Repositories\UserContextRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenerateCoverLetterController extends Controller
{
    public function __construct(protected OpenAIConnector $openAIConnector) {}

    public function __invoke(Request $request, JobApplication $jobApplication): JsonResponse
    {
        $request->validate([
            'cover_letter_template_id' => ['nullable', 'exists:cover_letter_templates,id'],
        ]);

        $coverLetterTemplate = $request->has('cover_letter_template_id')
            ? CoverLetterTemplate::query()->find($request->input('cover_letter_template_id'))
            : null;

        $payload = $this->buildChatPayload(
            $request->user(),
            $jobApplication,
            $coverLetterTemplate
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
        ?CoverLetterTemplate $coverLetterTemplate,
    ): array {
        $userRepository = new UserContextRepository($user);
        $userContext = $userRepository->buildContext();

        $jobApplicationContext = [
            [
                'role' => 'system',
                'content' => 'I am going to give you context to a user as well as the job application and I want you to craft a cover letter based on a prompt and details given.',
            ],
            [
                'role' => 'system',
                'content' => $jobApplication->ai_context_string,
            ],
        ];

        if ($coverLetterTemplate) {
            $jobApplicationContext[] = [
                'role' => 'system',
                'content' => 'Use this cover letter as a template: '.$coverLetterTemplate->body,
            ];
        }

        return [
            ...$userContext,
            ...$jobApplicationContext,
        ];
    }
}
