<?php
// get_cookies.php
// Endpoint API untuk mengambil preferensi pengguna dari cookie 'userPreferences' dan mengembalikan data dalam format JSON.

header('Content-Type: application/json');

// Function to safely get a cookie value
function getCookie($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

// Initialize default response
$response = [
    'hasPreferences' => false,
    'preferences' => null,
    'error' => null
];

// Check if userPreferences cookie exists
$userPreferences = getCookie('userPreferences');

if ($userPreferences) {
    // Attempt to decode the JSON data from the cookie
    $decodedPreferences = json_decode($userPreferences, true);
    
    // Check if JSON decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        $response['error'] = 'Failed to decode cookie data: ' . json_last_error_msg();
    } elseif (is_array($decodedPreferences) && !empty($decodedPreferences)) {
        // Successfully decoded and data is a non-empty array
        $response['hasPreferences'] = true;
        $response['preferences'] = $decodedPreferences;
    } else {
        $response['error'] = 'Cookie data is not a valid non-empty array.';
    }
} else {
    $response['error'] = 'No userPreferences cookie found.';
}

// Output JSON response
echo json_encode($response);
exit;
?>