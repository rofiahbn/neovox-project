<?php

// api/process.php

header('Content-Type: application/json');

require_once '../config.php';



// Sanitasi input dari klien

$input = json_decode(file_get_contents('php://input'), true);

$text = filter_var($input['text'] ?? '', FILTER_SANITIZE_STRING);

$context = filter_var($input['context'] ?? '', FILTER_SANITIZE_STRING);

$scenario = filter_var($input['scenario'] ?? 'General Practice', FILTER_SANITIZE_STRING);

$conversationHistory = isset($input['conversationHistory']) && is_array($input['conversationHistory']) 

    ? array_map(function($msg) {

        return [

            'sender' => filter_var($msg['sender'] ?? '', FILTER_SANITIZE_STRING),

            'text' => filter_var($msg['text'] ?? '', FILTER_SANITIZE_STRING),

            'timestamp' => filter_var($msg['timestamp'] ?? '', FILTER_SANITIZE_STRING)

        ];

    }, $input['conversationHistory'])

    : [];



// Fungsi untuk memanggil Open AI API

function callOpenAI($text, $context, $scenario, $conversationHistory) {

    global $openai_api_key;

    $url = '-api-';



    // Definisikan prompt berdasarkan skenario

    $scenarioPrompt = match ($scenario) {

        'Job Interview' => 'You are a professional interviewer conducting a job interview. Ask relevant questions about the candidate\'s experience, skills, or situational scenarios. Provide constructive feedback when appropriate.',

        'Ask for Directions' => 'You are a helpful local assisting someone asking for directions. Provide clear, concise, and accurate directions or ask clarifying questions to understand their needs.',

        'Shopping at the Mall' => 'You are a friendly store employee at a mall. Respond to customer inquiries about products, sizes, prices, or availability with a polite and helpful tone.',

        'Chat with a Friend' => 'You are a friendly conversationalist chatting with a friend. Keep the tone relaxed, engaging, and informal. Ask questions to keep the conversation flowing.',

        'My Own Scenario' => 'You are a conversational AI adapting to the user\'s chosen topic. Respond dynamically based on their input, keeping the conversation relevant and engaging.',

        'Surprise Me' => 'You are a creative conversationalist introducing a random, fun topic or scenario. Engage the user with an unexpected but approachable conversation starter.',

        'Grammar Feedback' => 'You are a language tutor analyzing the user\'s English input. Provide detailed feedback on grammar, spelling, and style. Suggest corrections and explain why they are needed. Tailor your explanation to the user\'s language level (based on context). If the input is correct, praise the user and suggest ways to enhance their expression.',

        default => 'You are a conversational AI assisting with general English practice. Respond to the user\'s input in a clear, friendly, and educational manner.'

    };



    // Bangun prompt dengan konteks dan riwayat percakapan

    $prompt = "You are Neovox.AI, an AI designed to help users practice English. The user's preferences are: $context. The current scenario is: $scenario. Below is the conversation history (if any):\n\n";

    

    foreach ($conversationHistory as $msg) {

        $prompt .= "[{$msg['sender']} at {$msg['timestamp']}]: {$msg['text']}\n";

    }



    $prompt .= "\nUser's current input: $text\n\n$scenarioPrompt\nRespond in English, keeping the tone friendly and appropriate for the scenario. Ensure the response is concise, educational, and aligns with the user's language level.";



    // Persiapkan data untuk API

    $data = [

        'model' => 'gpt-4o-mini',

        'messages' => [

            ['role' => 'system', 'content' => $prompt],

            ['role' => 'user', 'content' => $text]

        ],

        'max_tokens' => $scenario === 'Grammar Feedback' ? 500 : 200,

        'temperature' => 0.7

    ];



    // Inisialisasi cURL

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_HTTPHEADER, [

        'Content-Type: application/json',

        'Authorization: Bearer ' . $openai_api_key

    ]);



    // Eksekusi panggilan API

    $response = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $error = curl_error($ch);

    curl_close($ch);



    // Periksa error cURL

    if ($response === false) {

        error_log("cURL error in Open AI API call: $error");

        return ['error' => 'Failed to connect to Open AI API: ' . $error];

    }



    // Decode respons

    $result = json_decode($response, true);



    // Periksa error API

    if ($httpCode !== 200 || isset($result['error'])) {

        $errorMessage = $result['error']['message'] ?? 'Unknown API error';

        error_log("Open AI API error: HTTP $httpCode, Message: $errorMessage");

        return ['error' => 'Open AI API error: ' . $errorMessage];

    }



    // Kembalikan teks respons

    return ['text' => $result['choices'][0]['message']['content'] ?? 'Sorry, I couldn’t generate a response.'];

}



// Proses panggilan ke Open AI

$response = callOpenAI($text, $context, $scenario, $conversationHistory);



// Kembalikan respons ke klien

echo json_encode($response);

?>