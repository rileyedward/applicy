<?php

namespace App\Http\Controllers;

use App\Http\Integrations\OpenAI\OpenAIConnector;
use App\Http\Integrations\OpenAI\Requests\CreateChatRequest;
use App\Models\Application;
use App\Services\ChatRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    public function application(Request $request, Application $application): JsonResponse
    {
        $chatRequestService = new ChatRequestService($request->user(), $application);
        $payload = $chatRequestService->buildApplicationFollowUpChatRequestPayload();

        try {
            $connector = new OpenAIConnector;
            $request = new CreateChatRequest($payload);
            $response = $connector->send($request);

            $content = json_decode($response->body(), true);

            return response()->json([
                'follow_up' => $content['choices'][0]['message']['content'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function interview(Request $request, Application $application): JsonResponse
    {
        $chatRequestService = new ChatRequestService($request->user(), $application);
        $payload = $chatRequestService->buildInterviewFollowUpChatRequestPayload();

        try {
            $connector = new OpenAIConnector;
            $request = new CreateChatRequest($payload);
            $response = $connector->send($request);

            $content = json_decode($response->body(), true);

            return response()->json([
                'follow_up' => $content['choices'][0]['message']['content'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
