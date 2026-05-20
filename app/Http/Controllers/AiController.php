<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'question'      => 'required|string|max:2000',
            'selected_text' => 'nullable|string|max:5000',
        ]);

        $question     = $request->input('question');
        $selectedText = $request->input('selected_text');

        $userMessage = $selectedText
            ? "Контекст из урока:\n\"{$selectedText}\"\n\nВопрос: {$question}"
            : $question;

        $model = config('services.ai.model', 'gemini-2.0-flash');
        $key   = config('services.ai.key');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
            'systemInstruction' => [
                'parts' => [[
                    'text' => 'Ты помощник на образовательной платформе по SQL. Отвечай кратко и понятно на русском языке.',
                ]],
            ],
            'contents' => [[
                'role'  => 'user',
                'parts' => [['text' => $userMessage]],
            ]],
            'generationConfig' => [
                'maxOutputTokens' => 800,
                'temperature'     => 0.7,
            ],
        ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Ошибка Gemini API: ' . $response->status()
            ], 500);
        }

        $answer = $response->json('candidates.0.content.parts.0.text')
            ?? 'Не удалось получить ответ.';

        return response()->json(['answer' => $answer]);
    }
}
