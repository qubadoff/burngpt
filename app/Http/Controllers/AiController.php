<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use Illuminate\Http\JsonResponse;
use OpenAI;

class AiController extends Controller
{
    public function index(ChatRequest $request): JsonResponse
    {

        $message = $request->input('message');
        $client = OpenAI::client(env('OPENAI_API_KEY'));
        $maxTokens = 64;

        $result = $client->completions()->create([
            "model" => "text-davinci-003",
//            "temperature" => 0.7,
//            "top_p" => 1,
//            "frequency_penalty" => 0,
//            "presence_penalty" => 0,
//            'max_tokens' => 600,
//            'prompt' => sprintf('Write article about: %s', $message),

            'prompt' => $message,
            "temperature" => 0.7,
            "max_tokens" => $maxTokens,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            "stop" => ["\"\"\""]

        ]);

        $content = trim($result['choices'][0]['text']);


        return response()->json($content);

    }
}
