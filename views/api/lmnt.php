<?php

// api/lmnt.php

header('Content-Type: application/json');

require_once '../config.php';



$input = json_decode(file_get_contents('php://input'), true);

$text = filter_var($input['text'] ?? '', FILTER_SANITIZE_STRING);



function callLMNT($text) {

    global $lmnt_api_key;

    $url = '-api-';



    $data = [

        'text' => $text,

        'voice' => 'default-english',

        'format' => 'mp3'

    ];



    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_HTTPHEADER, [

        'Content-Type: application/json',

        'Authorization: Bearer ' . $lmnt_api_key

    ]);



    $response = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $error = curl_error($ch);

    curl_close($ch);



    if ($response === false) {

        error_log("cURL error in LMNT API call: $error");

        return ['error' => 'Failed to connect to LMNT API: ' . $error];

    }



    $result = json_decode($response, true);



    if ($httpCode !== 200 || isset($result['error'])) {

        $errorMessage = $result['error']['message'] ?? 'Unknown API error';

        error_log("LMNT API error: HTTP $httpCode, Message: $errorMessage");

        return ['error' => 'LMNT API error: ' . $errorMessage];

    }



    return ['audioUrl' => $result['audio_url'] ?? ''];

}



$response = callLMNT($text);

echo json_encode($response);

?>