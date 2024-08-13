<?php

namespace App\Http\Controllers;

use App\Http\Integrations\OpenAIConnector;
use App\Http\Integrations\Requests\CreateChatRequest;
use App\Models\JobApplication;
use App\Models\Resume;
use App\Models\User;
use App\Repositories\ResumeContextRepository;
use App\Repositories\UserContextRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviseResumeController extends Controller
{
    public function __construct(protected OpenAIConnector $openAIConnector) {}

    public function __invoke(Request $request, JobApplication $jobApplication): JsonResponse
    {
        $request->validate([
            'resume_id' => ['nullable', 'exists:resumes,id'],
        ]);

        $resume = $request->has('resume_id')
            ? Resume::query()->find($request->input('resume_id'))
            : null;

        $payload = $this->buildChatPayload(
            $request->user(),
            $jobApplication,
            $resume
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
        ?Resume $resume
    ): array {
        $userRepository = new UserContextRepository($user);
        $userContext = $userRepository->buildContext();

        $jobApplicationContext = [
            [
                'role' => 'system',
                'content' => 'I am going to give you context to a user as well as the job application and a resume as a template. I want you to provide tips for improving the resume based on the job application and the resume given.',
            ],
            [
                'role' => 'system',
                'content' => $jobApplication->ai_context_string,
            ],
        ];

        if ($resume) {
            $resumeRepository = new ResumeContextRepository($resume);
            $resumeContext = $resumeRepository->buildContext();

            $jobApplicationContext[] = [
                'role' => 'system',
                'content' => 'Use this resume as the tempalte: '.$resumeContext,
            ];
        }

        return [
            ...$userContext,
            ...$jobApplicationContext,
        ];
    }
}
