<?php
session_start();
require_once("{$_SERVER['DOCUMENT_ROOT']}/vendor/autoload.php");

$client = new Google_Client();
$client->setClientId('YOUR_GOOGLE_CLIENT_ID');
$client->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET');
$client->setRedirectUri('http://localhost/login');
$client->addScope('email');
$client->addScope('profile');

function sanitize($input) {
    return filter_var($input, FILTER_SANITIZE_STRING);
}

if (isset($_GET['code'])) {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            $error = 'Google authentication failed: ' . $token['error'];
        } else {
            $client->setAccessToken($token);
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();

            $_SESSION['user'] = [
                'email' => sanitize($userInfo->email),
                'name' => sanitize($userInfo->name)
            ];

            $userPreferences = [];
            if (isset($_COOKIE['userPreferences'])) {
                $cookiePreferences = json_decode($_COOKIE['userPreferences'], true);
                if (is_array($cookiePreferences) && !empty($cookiePreferences['language']) && !empty($cookiePreferences['level'])) {
                    $userPreferences = $cookiePreferences;
                }
            }

            header('Location: ' . (!empty($userPreferences) ? '/learning' : '/conversational-ai'));
            exit;
        }
    } catch (Exception $e) {
        $error = 'Error during authentication: ' . $e->getMessage();
    }
}

if (isset($_SESSION['user'])) {
    $userPreferences = [];
    if (isset($_COOKIE['userPreferences'])) {
        $cookiePreferences = json_decode($_COOKIE['userPreferences'], true);
        if (is_array($cookiePreferences) && !empty($cookiePreferences['language']) && !empty($cookiePreferences['level'])) {
            $userPreferences = $cookiePreferences;
        }
    }
    header('Location: ' . (!empty($userPreferences) ? '/learning' : '/conversational-ai'));
    exit;
}

$authUrl = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Neovox.AI - Sign In</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="/img/logoNeovox.png" type="image/png">
  <style>
    :root {
      --primary: #1B263B;
      --secondary: #415A77;
      --accent: #778DA9;
      --light: #E0E1DD;
      --white: #FFFFFF;
      --border: #E0E1DD;
      --glass-bg: rgba(255, 255, 255, 0.1);
      --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(145deg, #A8B5D2 0%, #D3DCE6 80%, #A8B5D2 100%);
      color: var(--primary);
      min-height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .container {
      max-width: 600px;
      width: 90%;
      padding: 2rem;
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      border: 1px solid var(--border);
      border-radius: 1.5rem;
      box-shadow: var(--glass-shadow);
      text-align: center;
    }
    .header h1 {
      font-size: clamp(1.5rem, 4vw, 2rem);
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 1rem;
    }
    .header h1 span {
      color: var(--accent);
    }
    .google-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1.5rem;
      background: #FFFFFF;
      border: 1px solid #DADCE0;
      border-radius: 0.75rem;
      font-size: clamp(0.9rem, 2.5vw, 1rem);
      font-weight: 500;
      color: #1F1F1F;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    .google-btn img {
      width: 20px;
      height: 20px;
    }
    .google-btn:hover {
      background: #F8F9FA;
      transform: scale(1.02);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .error {
      color: #FF6B6B;
      font-size: 0.85rem;
      margin-bottom: 1rem;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
      .container { padding: 1.5rem; }
      .header h1 { font-size: clamp(1.25rem, 3.5vw, 1.75rem); }
      .google-btn { font-size: clamp(0.85rem, 2.5vw, 0.9rem); padding: 0.6rem 1.2rem; }
    }
    @media (max-width: 480px) {
      .container { padding: 1rem; }
      .header h1 { font-size: clamp(1rem, 3vw, 1.5rem); }
      .google-btn { font-size: clamp(0.8rem, 2.5vw, 0.85rem); padding: 0.5rem 1rem; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Welcome to Neovox.<span>AI</span></h1>
    </div>
    <?php if (isset($error)): ?>
      <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <a href="<?php echo htmlspecialchars($authUrl); ?>" class="google-btn">
      <img src="https://www.google.com/favicon.ico" alt="Google Icon">
      Sign in with Google
    </a>
  </div>
</body>
</html>