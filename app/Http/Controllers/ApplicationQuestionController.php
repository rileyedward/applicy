<?php

namespace App\Http\Controllers;

use App\Http\Integrations\OpenAI\OpenAIConnector;
use App\Http\Integrations\OpenAI\Requests\CreateChatRequest;
use App\Models\Application;
use App\Services\ChatRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationQuestionController extends Controller
{
    public function __invoke(Request $request, Application $application): JsonResponse
    {
        $request->validate([
            'message' => ['required', 'string'],
        ]);

        $chatRequestService = new ChatRequestService($request->user(), $application);
        $payload = $chatRequestService->buildApplicationQuestionChatRequestPayload($request->input('message'));

        try {
            $connector = new OpenAIConnector;
            $request = new CreateChatRequest($payload);
            $response = $connector->send($request);

            $content = json_decode($response->body(), true);

            return response()->json([
                'answer' => $content['choices'][0]['message']['content'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
