<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;

class MediAiController extends Controller
{
    public function showMediAiPage()
    {
        return view('ai-support');
    }

    public function generate(Request $request, GeminiService $gemini)
    {
        $prompt = $request->input('prompt');

        if (empty($prompt)) {
            return back()->with([
                'response' => '',
                'prompt' => $prompt
            ]);
        }


        $firstAidPrompt = "You are a professional medical assistant. Give clear, step-by-step first-aid instructions for the following condition.

Rules:
1. Start numbering from 1.
2. Use sub-bullets for extra details.
3. Keep steps short and easy to follow.
4. Do NOT add introductions, explanations, or disclaimers. Go straight to the steps.
5. Keep the response short as possible (150 words).

Condition: " . $prompt;


        $response = $gemini->generatedContent($firstAidPrompt);

        if (is_array($response)) {
            $response = implode("\n", $response);
        }

        return back()->with([
            'response' => $response,
            'prompt' => $prompt
        ]);
    }
}
