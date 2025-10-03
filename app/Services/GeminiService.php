<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    public function generatedContent($prompt)
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . env('GEMINI_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        $data = $response->json();

        // Return the first AI response or a fallback message
        return $data['candidates'][0]['content']['parts'][0] ?? 'No response generated.';
    }
}
