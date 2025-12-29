<?php

session_start();



// Fungsi untuk sanitasi input

function sanitize($input) {

    return filter_var($input, FILTER_SANITIZE_STRING);

}



// Inisialisasi preferensi pengguna

$userPreferences = $_SESSION['userPreferences'] ?? [];

if (empty($userPreferences) && isset($_COOKIE['userPreferences'])) {

    $decodedPreferences = json_decode($_COOKIE['userPreferences'], true);

    if (is_array($decodedPreferences) && !empty($decodedPreferences)) {

        $userPreferences = $decodedPreferences;

        $_SESSION['userPreferences'] = $userPreferences;

    }

}



$currentSection = $_SESSION['currentSection'] ?? 'loginSection';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $step = sanitize($_POST['step'] ?? '');

    

    if ($step === 'login') {

        $loginMethod = sanitize($_POST['loginMethod'] ?? 'guest');

        $userPreferences['loginMethod'] = $loginMethod;

        $currentSection = 'nameSection';

    } elseif ($step === 'name') {

        $userPreferences['name'] = sanitize($_POST['name'] ?? '');

        $currentSection = 'levelSection';

    } elseif ($step === 'level') {

        $userPreferences['level'] = sanitize($_POST['level'] ?? 'Intermediate');

        $currentSection = 'reasonSection';

    } elseif ($step === 'reason') {

        $userPreferences['reason'] = sanitize($_POST['reason'] ?? '');

        $currentSection = 'goalSection';

    } elseif ($step === 'goal') {

        $userPreferences['goal'] = sanitize($_POST['goal'] ?? 'conversational');

        $currentSection = 'learningStyleSection';

    } elseif ($step === 'learningStyle') {

        $userPreferences['learningStyle'] = sanitize($_POST['learningStyle'] ?? '');

        $currentSection = 'ageSection';

    } elseif ($step === 'age') {

        $userPreferences['age'] = sanitize($_POST['age'] ?? '');

        $currentSection = 'practiceSection';

    } elseif ($step === 'practice') {

        $userPreferences['practice'] = sanitize($_POST['practice'] ?? '');

        $currentSection = 'contentSection';

    } elseif ($step === 'content') {

        $userPreferences['content'] = sanitize($_POST['content'] ?? '');

        $userPreferences['translation'] = $userPreferences['translation'] ?? 'English';

        $_SESSION['userPreferences'] = $userPreferences;

        setcookie('userPreferences', json_encode($userPreferences), time() + (30 * 24 * 60 * 60), "/");

        header('Location: /learning');

        exit();

    }

    

    $_SESSION['userPreferences'] = $userPreferences;

    $_SESSION['currentSection'] = $currentSection;

    setcookie('userPreferences', json_encode($userPreferences), time() + (30 * 24 * 60 * 60), "/");

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Neovox.AI - Setup Your Preferences</title>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

  <style>

    * {

      margin: 0;

      padding: 0;

      box-sizing: border-box;

    }

    body {

      font-family: 'Montserrat';

      background: url('img/onBoarding.jpg'); 

      background-size: cover;

      background-position: center;

      background-repeat: no-repeat;

      min-height: 100vh;

      display: flex;

      justify-content: center;

      align-items: flex-start;

      color: white;

      padding: clamp(10px, 2vw, 20px);

      overflow-x: hidden;

      position: relative;

    }

    .container {

      width: 100%;

      max-width: 360px;

      text-align: center;

      min-height: 100vh;

      display: flex;

      flex-direction: column;

      justify-content: space-between;

      padding-bottom: clamp(40px, 8vh, 80px);

      position: relative;

    }

    .content-wrapper {

      flex: 1;

      display: flex;

      flex-direction: column;

      justify-content: flex-start;

      align-items: center;

      padding-top: clamp(10px, 2vh, 20px);

      overflow-y: auto;

    }

    .header {

      position: relative;

      width: 100%;

      height: clamp(60px, 12vh, 80px);

      margin-bottom: clamp(10px, 2vh, 20px);

      z-index: 1;

    }

    .header-logo {

      position: absolute;

      width: clamp(110px, 40vw, 147px);

      height: clamp(30px, 5vh, 37px);

      left: 50%;

      transform: translateX(-50%);

      top: clamp(25px, 5vh, 35.63px);

      object-fit: contain;

    }

    .purple-layer-login {

      position: absolute;

      width: clamp(140px, 60vw, 223.67px);

      height: clamp(140px, 60vw, 223.67px);

      left: 50%;

      top: clamp(100px, 20vh, 150px);

      transform: translateX(-50%);

      background: #8623F0;

      border: 1px solid #FFFFFF;

      filter: blur(clamp(25px, 10vw, 40px));

      border-radius: 50%;

      z-index: 1;

    }

    .purple-layer-section {

      position: absolute;

      width: clamp(140px, 60vw, 223.67px);

      height: clamp(140px, 60vw, 223.67px);

      left: clamp(42px, 15vw, 68px);

      top: clamp(52px, 10vh, 84.31px);

      background: #8623F0;

      border: 1px solid #FFFFFF;

      filter: blur(clamp(25px, 10vw, 40px));

      border-radius: 50%;

      z-index: 1;

    }

    .custom-mascot-login {

      position: absolute;

      width: clamp(140px, 60vw, 223.58px);

      height: clamp(125px, 53vw, 199px);

      top: clamp(100px, 20vh, 150px);

      left: 50%;

      transform: translateX(-50%);

      z-index: 2;

    }

    .custom-mascot-section {

      position: absolute;

      width: clamp(140px, 60vw, 223.58px);

      height: clamp(125px, 53vw, 199px);

      left: clamp(42px, 15vw, 68px);

      top: clamp(52px, 10vh, 84.31px);

      z-index: 2;

    }

    h2 {

      font-size: clamp(1.1rem, 4vw, 1.5rem);

      font-weight: 600;

      margin-bottom: clamp(8px, 2vh, 12px);

      line-height: 1.3;

    }

    #loginSection h2 {

      margin-top: clamp(200px, 40vh, 250px);

    }

    .section:not(#loginSection) h2 {

      margin-top: clamp(260px, 50vh, 320px);

    }

    p {

      font-size: clamp(0.75rem, 3vw, 0.9rem);

      color: #d1d5db;

      margin-bottom: clamp(12px, 3vh, 20px);

      line-height: 1.5;

    }

    .input-field {

      width: 100%;

      padding: clamp(8px, 2vw, 12px);

      border: none;

      border-radius: 8px;

      font-size: clamp(0.85rem, 3vw, 1rem);

      margin-bottom: clamp(12px, 3vh, 20px);

      background: rgba(0, 0, 0, 0.2);

      backdrop-filter: blur(21.8px);

      color: white;

    }

    .input-field::placeholder {

      color: #9ca3af;

    }

    .select-field {

      width: 100%;

      padding: clamp(8px, 2vw, 12px);

      border: none;

      border-radius: 8px;

      font-size: clamp(0.85rem, 3vw, 1rem);

      margin-bottom: clamp(12px, 3vh, 20px);

      background: rgba(0, 0, 0, 0.2);

      backdrop-filter: blur(21.8px);

      color: white;

      appearance: none;

      background-image: url('data:image/svg+xml;utf8,<svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');

      background-repeat: no-repeat;

      background-position: right 10px center;

    }

    .option-grid {

      display: grid;

      grid-template-columns: 1fr;

      gap: clamp(8px, 2vh, 12px);

      margin-bottom: clamp(12px, 3vh, 20px);

      width: 100%;

    }

    .option {

      padding: clamp(8px, 2vw, 12px);

      border-radius: 8px;

      background: rgba(0, 0, 0, 0.2);

      backdrop-filter: blur(21.8px);

      font-size: clamp(0.85rem, 3vw, 1rem);

      cursor: pointer;

      transition: background 0.3s ease;

      text-align: center;

    }

    .option:hover {

      background: #374151;

    }

    .option.selected {

      background: linear-gradient(90deg, #B009DE 0%, #7031F9 100%);

      border: 0.5px solid rgba(255, 169, 249, 0.75);

      backdrop-filter: blur(21.8px);

    }

    .next-btn {

      position: fixed;

      bottom: clamp(10px, 2vh, 20px);

      left: 50%;

      transform: translateX(-50%);

      padding: clamp(8px, 2vw, 12px) clamp(15px, 4vw, 20px);

      border: none;

      border-radius: 8px;

      font-size: clamp(0.85rem, 3vw, 1rem);

      font-weight: 500;

      cursor: pointer;

      background: white;

      color: black;

      transition: opacity 0.3s ease;

      width: clamp(200px, 90%, 360px);

      z-index: 3;

    }

    .next-btn:disabled {

      opacity: 0.5;

      cursor: not-allowed;

    }

    .login-btn-container {

      position: relative;

      width: clamp(162px, 72vw, 260.08px);

      margin: 0 auto;

      margin-top: clamp(300px, 60vh, 400px);

      display: flex;

      flex-direction: column;

      gap: clamp(8px, 2vh, 12px);

      z-index: 3;

    }

    .login-btn {

      position: relative;

      display: flex;

      align-items: center;

      justify-content: center;

      gap: clamp(8px, 2vw, 12px);

      width: 100%;

      height: clamp(25px, 8vh, 40.71px);

      border: none;

      border-radius: clamp(4px, 1vw, 7.54px);

      font-size: clamp(0.85rem, 3vw, 1rem);

      font-weight: 500;

      cursor: pointer;

      transition: opacity 0.3s ease;

      box-shadow: 0px 0px 2.26px rgba(0, 0, 0, 0.084), 0px 1.51px 2.26px rgba(0, 0, 0, 0.168);

      padding: 0 clamp(10px, 3vw, 20px);

    }

    .login-btn[data-method="google"] {

      background: #FFFFFF;

      color: black;

    }

    .login-btn[data-method="apple"] {

      background: #000000;

      color: #FFFFFF;

    }

    .login-btn svg {

      width: clamp(12px, 5vw, 20px);

      height: clamp(12px, 5vw, 20px);

    }

    .guest-link {

      position: relative;

      width: 100%;

      height: clamp(25px, 8vh, 40.71px);

      font-size: clamp(0.75rem, 3vw, 0.9rem);

      line-height: clamp(25px, 8vh, 40.71px);

      color: #d1d5db;

      text-decoration: none;

      transition: color 0.3s ease;

      text-align: center;

      margin-top: clamp(8px, 2vh, 12px);

    }

    .guest-link:hover {

      color: white;

    }

    .terms-conditions {

      position: relative;

      width: 100%;

      font-family: 'Montserrat';

      font-style: normal;

      font-weight: 400;

      font-size: clamp(5px, 2vw, 8px);

      line-height: clamp(6px, 2vh, 10px);

      text-decoration-line: underline;

      color: #FFFFFF;

      margin-top: clamp(20px, 4vh, 30px);

      margin-bottom: clamp(10px, 2vh, 20px);

      text-align: center;

    }

    .back-btn {

      position: fixed;

      top: clamp(5px, 1vh, 10px);

      left: clamp(5px, 1vw, 10px);

      background: none;

      border: none;

      color: white;

      font-size: clamp(1rem, 4vw, 1.5rem);

      cursor: pointer;

      z-index: 3;

    }

    .section {

      display: none;

      opacity: 0;

      transition: opacity 0.3s ease;

      width: 100%;

    }

    .section.active {

      display: block;

      opacity: 1;

    }



    /* Responsivitas untuk tablet (max-width: 768px) */

    @media (max-width: 768px) {

      body {

        padding: clamp(10px, 2vw, 20px);

      }

      .container {

        max-width: 360px;

        padding-bottom: clamp(40px, 8vh, 80px);

      }

      .content-wrapper {

        padding-top: clamp(10px, 2vh, 20px);

      }

      .header {

        height: clamp(60px, 12vh, 80px);

        margin-bottom: clamp(10px, 2vh, 20px);

      }

      .header-logo {

        width: clamp(110px, 40vw, 147px);

        height: clamp(30px, 5vh, 37px);

        top: clamp(25px, 5vh, 35.63px);

      }

      .purple-layer-login {

        width: clamp(140px, 60vw, 223.67px);

        height: clamp(140px, 60vw, 223.67px);

        top: clamp(100px, 20vh, 150px);

        filter: blur(clamp(25px, 10vw, 40px));

      }

      .purple-layer-section {

        width: clamp(140px, 60vw, 223.67px);

        height: clamp(140px, 60vw, 223.67px);

        left: clamp(42px, 15vw, 68px);

        top: clamp(52px, 10vh, 84.31px);

        filter: blur(clamp(25px, 10vw, 40px));

      }

      .custom-mascot-login {

        width: clamp(140px, 60vw, 223.58px);

        height: clamp(125px, 53vw, 199px);

        top: clamp(100px, 20vh, 150px);

      }

      .custom-mascot-section {

        width: clamp(140px, 60vw, 223.58px);

        height: clamp(125px, 53vw, 199px);

        left: clamp(42px, 15vw, 68px);

        top: clamp(52px, 10vh, 84.31px);

      }

      .login-btn-container {

        width: clamp(162px, 72vw, 260.08px);

        margin-top: clamp(300px, 60vh, 400px);

        gap: clamp(8px, 2vh, 12px);

      }

      .login-btn {

        height: clamp(25px, 8vh, 40.71px);

        border-radius: clamp(4px, 1vw, 7.54px);

        font-size: clamp(0.85rem, 3vw, 1rem);

        padding: 0 clamp(10px, 3vw, 20px);

      }

      .login-btn svg {

        width: clamp(12px, 5vw, 20px);

        height: clamp(12px, 5vw, 20px);

      }

      .guest-link {

        height: clamp(25px, 8vh, 40.71px);

        line-height: clamp(25px, 8vh, 40.71px);

        font-size: clamp(0.75rem, 3vw, 0.9rem);

        margin-top: clamp(8px, 2vh, 12px);

      }

      .terms-conditions {

        font-size: clamp(5px, 2vw, 8px);

        line-height: clamp(6px, 2vh, 10px);

        margin-top: clamp(20px, 4vh, 30px);

        margin-bottom: clamp(10px, 2vh, 20px);

      }

      .input-field, .select-field {

        padding: clamp(8px, 2vw, 12px);

        font-size: clamp(0.85rem, 3vw, 1rem);

      }

      .option {

        padding: clamp(8px, 2vw, 12px);

        font-size: clamp(0.85rem, 3vw, 1rem);

      }

      #loginSection h2 {

        margin-top: clamp(200px, 40vh, 250px);

      }

      .section:not(#loginSection) h2 {

        margin-top: clamp(260px, 50vh, 320px);

      }

    }



    /* Responsivitas untuk mobile (max-width: 480px) */

    @media (max-width: 480px) {

      body {

        padding: clamp(10px, 2vw, 20px);

      }

      .container {

        max-width: 360px;

        padding-bottom: clamp(40px, 8vh, 80px);

      }

      .content-wrapper {

        padding-top: clamp(10px, 2vh, 20px);

      }

      .header {

        height: clamp(60px, 12vh, 80px);

        margin-bottom: clamp(10px, 2vh, 20px);

      }

      .header-logo {

        width: clamp(110px, 40vw, 147px);

        height: clamp(30px, 5vh, 37px);

        top: clamp(25px, 5vh, 35.63px);

      }

      .purple-layer-login {

        width: clamp(140px, 60vw, 223.67px);

        height: clamp(140px, 60vw, 223.67px);

        top: clamp(100px, 20vh, 150px);

        filter: blur(clamp(25px, 10vw, 40px));

      }

      .purple-layer-section {

        width: clamp(140px, 60vw, 223.67px);

        height: clamp(140px, 60vw, 223.67px);

        left: clamp(42px, 15vw, 68px);

        top: clamp(52px, 10vh, 84.31px);

        filter: blur(clamp(25px, 10vw, 40px));

      }

      .custom-mascot-login {

        width: clamp(140px, 60vw, 223.58px);

        height: clamp(125px, 53vw, 199px);

        top: clamp(100px, 20vh, 150px);

      }

      .custom-mascot-section {

        width: clamp(140px, 60vw, 223.58px);

        height: clamp(125px, 53vw, 199px);

        left: clamp(42px, 15vw, 68px);

        top: clamp(52px, 10vh, 84.31px);

      }

      .login-btn-container {

        width: clamp(162px, 72vw, 260.08px);

        margin-top: clamp(300px, 60vh, 400px);

        gap: clamp(8px, 2vh, 12px);

      }

      .login-btn {

        height: clamp(25px, 8vh, 40.71px);

        border-radius: clamp(4px, 1vw, 7.54px);

        font-size: clamp(0.85rem, 3vw, 1rem);

        padding: 0 clamp(10px, 3vw, 20px);

      }

      .login-btn svg {

        width: clamp(12px, 5vw, 20px);

        height: clamp(12px, 5vw, 20px);

      }

      .guest-link {

        height: clamp(25px, 8vh, 40.71px);

        line-height: clamp(25px, 8vh, 40.71px);

        font-size: clamp(0.75rem, 3vw, 0.9rem);

        margin-top: clamp(8px, 2vh, 12px);

      }

      .terms-conditions {

        font-size: clamp(5px, 2vw, 8px);

        line-height: clamp(6px, 2vh, 10px);

        margin-top: clamp(20px, 4vh, 30px);

        margin-bottom: clamp(10px, 2vh, 20px);

      }

      .input-field, .select-field {

        padding: clamp(8px, 2vw, 12px);

        font-size: clamp(0.85rem, 3vw, 1rem);

      }

      .option {

        padding: clamp(8px, 2vw, 12px);

        font-size: clamp(0.85rem, 3vw, 1rem);

      }

      .back-btn {

        top: clamp(5px, 1vh, 10px);

        left: clamp(5px, 1vw, 10px);

        font-size: clamp(1rem, 4vw, 1.5rem);

      }

      #loginSection h2 {

        margin-top: clamp(200px, 40vh, 250px);

      }

      .section:not(#loginSection) h2 {

        margin-top: clamp(260px, 50vh, 320px);

      }

    }

  </style>

</head>

<body>

  <div class="container">

    <div class="content-wrapper">

      <!-- Login Section -->

      <section class="section <?php echo $currentSection === 'loginSection' ? 'active' : ''; ?>" id="loginSection">

        <div class="header">

          <img src="/img/ikon.png" alt="Neovox.ai Logo" class="header-logo">

        </div>

        <div class="purple-layer-login"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-login">

        <form id="loginForm" method="POST">

          <input type="hidden" name="step" value="login">

          <input type="hidden" name="loginMethod" id="loginMethod" value="guest">

          <div class="login-btn-container">

            <button type="submit" class="login-btn" data-method="google" aria-label="Continue with Google">

              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>

                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-1.02.68-2.31 1.08-3.71 1.08-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>

                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>

                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>

              </svg>

              Continue with Google

            </button>

            <button type="submit" class="login-btn" data-method="apple" aria-label="Continue with Apple">

              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <path d="M17.05 20.28c-.98 1.19-2.16 1.68-3.53 1.68-1.38 0-2.47-.49-3.53-1.68-1.06-1.19-2.16-3.37-2.16-5.55 0-2.18 1.1-4.36 2.16-5.55 1.06-1.19 2.15-1.68 3.53-1.68 1.38 0 2.47.49 3.53 1.68 1.06 1.19 2.16 3.37 2.16 5.55 0 2.18-1.1 4.36-2.16 5.55zM12 4.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" fill="#FFF"/>

              </svg>

              Continue with Apple

            </button>

            <a href="#" class="guest-link" data-method="guest" aria-label="Start as a Guest">Start as a Guest</a>

            <a href="#" class="terms-conditions" aria-label="Terms and Conditions">Terms and Conditions</a>

          </div>

        </form>

      </section>



      <!-- Name Section -->

      <section class="section <?php echo $currentSection === 'nameSection' ? 'active' : ''; ?>" id="nameSection">

        <button class="back-btn" onclick="goBack('nameSection', 'loginSection')">←</button>

        <div class="purple-layer-section"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-section">

        <h2>What's your name?</h2>

        <p>Hi there! Before we dive in and get to know each other better, why don't you drop your name first? That way, I can get to know you a little more personally!</p>

        <form id="nameForm" method="POST">

          <input type="hidden" name="step" value="name">

          <input type="text" name="name" class="input-field" placeholder="Type Here" value="<?php echo htmlspecialchars($userPreferences['name'] ?? ''); ?>" required>

          <button type="submit" class="next-btn">Next</button>

        </form>

      </section>

      <!-- Level Section -->

      <section class="section <?php echo $currentSection === 'levelSection' ? 'active' : ''; ?>" id="levelSection">

        <button class="back-btn" onclick="goBack('levelSection', 'nameSection')">←</button>

        <div class="purple-layer-section"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-section">

        <h2>What's your English level?</h2>

        <p>Let's find out how comfy you are with English! From just starting out to totally fluent, your level helps us match the right content for you—so learning feels just right.</p>

        <form id="levelForm" method="POST">

          <input type="hidden" name="step" value="level">

          <input type="hidden" name="level" id="levelInput">

          <div class="option-grid" id="levelGrid">

            <div class="option" data-level="Beginner">Beginner</div>

            <div class="option" data-level="Intermediate">Intermediate</div>

            <div class="option" data-level="Upper-intermediate">Upper-intermediate</div>

            <div class="option" data-level="Advanced">Advanced</div>

          </div>

          <button type="submit" class="next-btn" disabled>Next</button>

        </form>

      </section>



      <!-- Reason Section -->

      <section class="section <?php echo $currentSection === 'reasonSection' ? 'active' : ''; ?>" id="reasonSection">

        <button class="back-btn" onclick="goBack('reasonSection', 'levelSection')">←</button>

        <div class="purple-layer-section"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-section">

        <h2>What is your primary reason for learning English?</h2>

        <p>Let's find out what's driving you to learn English! From just starting out to totally fluent, your level helps us match the right content for you—so learning feels just right.</p>

        <form id="reasonForm" method="POST">

          <input type="hidden" name="step" value="reason">

          <input type="hidden" name="reason" id="reasonInput">

          <div class="option-grid" id="reasonGrid">

            <div class="option" data-reason="Practice speaking English">Practice speaking English</div>

            <div class="option" data-reason="Build my vocabulary">Build my vocabulary</div>

            <div class="option" data-reason="Improve my writing">Improve my writing</div>

            <div class="option" data-reason="Understand spoken English better">Understand spoken English better</div>

            <div class="option" data-reason="Study grammar and rules">Study grammar and rules</div>

            <div class="option" data-reason="Prepare for an English test">Prepare for an English test</div>

          </div>

          <button type="submit" class="next-btn" disabled>Next</button>

        </form>

      </section>



      <!-- Goal Section -->

      <section class="section <?php echo $currentSection === 'goalSection' ? 'active' : ''; ?>" id="goalSection">

        <button class="back-btn" onclick="goBack('goalSection', 'reasonSection')">←</button>

        <div class="purple-layer-section"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-section">

        <h2>What are you looking to achieve?</h2>

        <p>Let's understand your goals so we can tailor your learning experience.</p>

        <form id="goalForm" method="POST">

          <input type="hidden" name="step" value="goal">

          <input type="hidden" name="goal" id="goalInput">

          <div class="option-grid" id="goalGrid">

            <div class="option" data-goal="conversational">Improve conversational skills</div>

            <div class="option" data-goal="exams">Prepare for exams</div>

            <div class="option" data-goal="career">Advance career opportunities</div>

          </div>

          <button type="submit" class="next-btn" disabled>Next</button>

        </form>

      </section>



      <!-- Learning Style Section -->

      <section class="section <?php echo $currentSection === 'learningStyleSection' ? 'active' : ''; ?>" id="learningStyleSection">

        <button class="back-btn" onclick="goBack('learningStyleSection', 'goalSection')">←</button>

        <div class="purple-layer-section"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-section">

        <h2>What's your learning style?</h2>

        <p>Understanding your learning style helps us customize your lessons.</p>

        <form id="learningStyleForm" method="POST">

          <input type="hidden" name="step" value="learningStyle">

          <input type="hidden" name="learningStyle" id="learningStyleInput">

          <div class="option-grid" id="learningStyleGrid">

            <div class="option" data-style="visual">Visual (images, videos)</div>

            <div class="option" data-style="auditory">Auditory (listening, speaking)</div>

            <div class="option" data-style="kinesthetic">Kinesthetic (hands-on, activities)</div>

            <div class="option" data-style="reading-writing">Reading/Writing (texts, notes)</div>

          </div>

          <button type="submit" class="next-btn" disabled>Next</button>

        </form>

      </section>



      <!-- Age Section -->

      <section class="section <?php echo $currentSection === 'ageSection' ? 'active' : ''; ?>" id="ageSection">

        <button class="back-btn" onclick="goBack('ageSection', 'learningStyleSection')">←</button>

        <div class="purple-layer-section"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-section">

        <h2>How old are you?</h2>

        <p>Your age helps us tailor the learning experience to your needs.</p>

        <form id="ageForm" method="POST">

          <input type="hidden" name="step" value="age">

          <input type="hidden" name="age" id="ageInput">

          <div class="option-grid" id="ageGrid">

            <div class="option" data-age="under-18">Under 18</div>

            <div class="option" data-age="18-24">18-24</div>

            <div class="option" data-age="25-34">25-34</div>

            <div class="option" data-age="35-44">35-44</div>

            <div class="option" data-age="45+">45+</div>

          </div>

          <button type="submit" class="next-btn" disabled>Next</button>

        </form>

      </section>



      <!-- Practice Frequency Section -->

      <section class="section <?php echo $currentSection === 'practiceSection' ? 'active' : ''; ?>" id="practiceSection">

        <button class="back-btn" onclick="goBack('practiceSection', 'ageSection')">←</button>

        <div class="purple-layer-section"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-section">

        <h2>How often do you want to practice?</h2>

        <p>Let us know how frequently you'd like to practice to achieve your goals.</p>

        <form id="practiceForm" method="POST">

          <input type="hidden" name="step" value="practice">

          <input type="hidden" name="practice" id="practiceInput">

          <div class="option-grid" id="practiceGrid">

            <div class="option" data-frequency="daily">Daily</div>

            <div class="option" data-frequency="few-times-weekly">A few times a week</div>

            <div class="option" data-frequency="weekly">Once a week</div>

            <div class="option" data-frequency="occasionally">Occasionally</div>

          </div>

          <button type="submit" class="next-btn" disabled>Next</button>

        </form>

      </section>



      <!-- Content Section -->

      <section class="section <?php echo $currentSection === 'contentSection' ? 'active' : ''; ?>" id="contentSection">

        <button class="back-btn" onclick="goBack('contentSection', 'practiceSection')">←</button>

        <div class="purple-layer-section"></div>

        <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot-section">

        <h2>What kind of topics do you enjoy the most?</h2>

        <p>By sharing your favorite topics, the AI can give you better, more relevant content to match your vibe!</p>

        <form id="contentForm" method="POST">

          <input type="hidden" name="step" value="content">

          <input type="hidden" name="content" id="contentInput">

          <div class="option-grid" id="contentGrid">

            <div class="option" data-content="Art">Art</div>

            <div class="option" data-content="Technology">Technology</div>

            <div class="option" data-content="Travel">Travel</div>

            <div class="option" data-content="Food">Food</div>

            <div class="option" data-content="Sports">Sports</div>

          </div>

          <button type="submit" class="next-btn" disabled>Next</button>

        </form>

      </section>

    </div>

  </div>



  <script>

    // Inisialisasi preferensi dari sesi

    const userPreferences = <?php echo json_encode($userPreferences); ?>;

    const currentSection = '<?php echo $currentSection; ?>';



    // Fungsi untuk navigasi antar section

    function showSection(sectionToShow, sectionToHide) {

      sectionToHide.style.opacity = '0';

      sectionToHide.style.transition = 'opacity 0.3s ease';

      setTimeout(() => {

        sectionToHide.classList.remove('active');

        sectionToShow.classList.add('active');

        sectionToShow.style.opacity = '0';

        sectionToShow.style.transition = 'opacity 0.3s ease';

        setTimeout(() => {

          sectionToShow.style.opacity = '1';

        }, 50);

      }, 300);

    }



    function goBack(currentSectionId, previousSectionId) {

      const currentSection = document.getElementById(currentSectionId);

      const previousSection = document.getElementById(previousSectionId);

      showSection(previousSection, currentSection);

    }



    // Inisialisasi nilai awal dari sesi

    document.addEventListener('DOMContentLoaded', () => {

      const initialSection = document.getElementById(currentSection);

      if (initialSection) {

        initialSection.classList.add('active');

        initialSection.style.opacity = '1';

      }



      // Login Section

      const loginForm = document.getElementById('loginForm');

      const loginMethodInput = document.getElementById('loginMethod');

      const loginButtons = loginForm.querySelectorAll('.login-btn');

      const guestLink = loginForm.querySelector('.guest-link');



      loginButtons.forEach(button => {

        button.addEventListener('click', (e) => {

          e.preventDefault();

          const method = button.getAttribute('data-method');

          loginMethodInput.value = method;

          const formData = new FormData(loginForm);

          fetch(window.location.href, {

            method: 'POST',

            body: formData

          }).then(() => {

            showSection(document.getElementById('nameSection'), document.getElementById('loginSection'));

          });

        });

      });



      guestLink.addEventListener('click', (e) => {

        e.preventDefault();

        loginMethodInput.value = 'guest';

        const formData = new FormData(loginForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          showSection(document.getElementById('nameSection'), document.getElementById('loginSection'));

        });

      });



      // Name Section

      const nameForm = document.getElementById('nameForm');

      nameForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const formData = new FormData(nameForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          showSection(document.getElementById('levelSection'), document.getElementById('nameSection'));

        });

      });


      // Level Section

      const levelForm = document.getElementById('levelForm');

      const levelOptions = document.querySelectorAll('#levelGrid .option');

      const levelInput = document.querySelector('#levelInput');

      const levelBtn = levelForm.querySelector('.next-btn');

      levelOptions.forEach(option => {

        if (userPreferences.level === option.getAttribute('data-level')) {

          option.classList.add('selected');

          levelInput.value = userPreferences.level;

          levelBtn.disabled = false;

        }

        option.addEventListener('click', () => {

          levelOptions.forEach(opt => opt.classList.remove('selected'));

          option.classList.add('selected');

          levelInput.value = option.getAttribute('data-level');

          levelBtn.disabled = false;

        });

      });

      levelForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const formData = new FormData(levelForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          showSection(document.getElementById('reasonSection'), document.getElementById('levelSection'));

        });

      });



      // Reason Section

      const reasonForm = document.getElementById('reasonForm');

      const reasonOptions = document.querySelectorAll('#reasonGrid .option');

      const reasonInput = document.querySelector('#reasonInput');

      const reasonBtn = reasonForm.querySelector('.next-btn');

      reasonOptions.forEach(option => {

        if (userPreferences.reason === option.getAttribute('data-reason')) {

          option.classList.add('selected');

          reasonInput.value = userPreferences.reason;

          reasonBtn.disabled = false;

        }

        option.addEventListener('click', () => {

          reasonOptions.forEach(opt => opt.classList.remove('selected'));

          option.classList.add('selected');

          reasonInput.value = option.getAttribute('data-reason');

          reasonBtn.disabled = false;

        });

      });

      reasonForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const formData = new FormData(reasonForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          showSection(document.getElementById('goalSection'), document.getElementById('reasonSection'));

        });

      });



      // Goal Section

      const goalForm = document.getElementById('goalForm');

      const goalOptions = document.querySelectorAll('#goalGrid .option');

      const goalInput = document.querySelector('#goalInput');

      const goalBtn = goalForm.querySelector('.next-btn');

      goalOptions.forEach(option => {

        if (userPreferences.goal === option.getAttribute('data-goal')) {

          option.classList.add('selected');

          goalInput.value = userPreferences.goal;

          goalBtn.disabled = false;

        }

        option.addEventListener('click', () => {

          goalOptions.forEach(opt => opt.classList.remove('selected'));

          option.classList.add('selected');

          goalInput.value = option.getAttribute('data-goal');

          goalBtn.disabled = false;

        });

      });

      goalForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const formData = new FormData(goalForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          showSection(document.getElementById('learningStyleSection'), document.getElementById('goalSection'));

        });

      });



      // Learning Style Section

      const learningStyleForm = document.getElementById('learningStyleForm');

      const learningStyleOptions = document.querySelectorAll('#learningStyleGrid .option');

      const learningStyleInput = document.querySelector('#learningStyleInput');

      const learningStyleBtn = learningStyleForm.querySelector('.next-btn');

      learningStyleOptions.forEach(option => {

        if (userPreferences.learningStyle === option.getAttribute('data-style')) {

          option.classList.add('selected');

          learningStyleInput.value = userPreferences.learningStyle;

          learningStyleBtn.disabled = false;

        }

        option.addEventListener('click', () => {

          learningStyleOptions.forEach(opt => opt.classList.remove('selected'));

          option.classList.add('selected');

          learningStyleInput.value = option.getAttribute('data-style');

          learningStyleBtn.disabled = false;

        });

      });

      learningStyleForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const formData = new FormData(learningStyleForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          showSection(document.getElementById('ageSection'), document.getElementById('learningStyleSection'));

        });

      });



      // Age Section

      const ageForm = document.getElementById('ageForm');

      const ageOptions = document.querySelectorAll('#ageGrid .option');

      const ageInput = document.querySelector('#ageInput');

      const ageBtn = ageForm.querySelector('.next-btn');

      ageOptions.forEach(option => {

        if (userPreferences.age === option.getAttribute('data-age')) {

          option.classList.add('selected');

          ageInput.value = userPreferences.age;

          ageBtn.disabled = false;

        }

        option.addEventListener('click', () => {

          ageOptions.forEach(opt => opt.classList.remove('selected'));

          option.classList.add('selected');

          ageInput.value = option.getAttribute('data-age');

          ageBtn.disabled = false;

        });

      });

      ageForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const formData = new FormData(ageForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          showSection(document.getElementById('practiceSection'), document.getElementById('ageSection'));

        });

      });



      // Practice Frequency Section

      const practiceForm = document.getElementById('practiceForm');

      const practiceOptions = document.querySelectorAll('#practiceGrid .option');

      const practiceInput = document.querySelector('#practiceInput');

      const practiceBtn = practiceForm.querySelector('.next-btn');

      practiceOptions.forEach(option => {

        if (userPreferences.practice === option.getAttribute('data-frequency')) {

          option.classList.add('selected');

          practiceInput.value = userPreferences.practice;

          practiceBtn.disabled = false;

        }

        option.addEventListener('click', () => {

          practiceOptions.forEach(opt => opt.classList.remove('selected'));

          option.classList.add('selected');

          practiceInput.value = option.getAttribute('data-frequency');

          practiceBtn.disabled = false;

        });

      });

      practiceForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const formData = new FormData(practiceForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          showSection(document.getElementById('contentSection'), document.getElementById('practiceSection'));

        });

      });



      // Content Section

      const contentForm = document.getElementById('contentForm');

      const contentOptions = document.querySelectorAll('#contentGrid .option');

      const contentInput = document.querySelector('#contentInput');

      const contentBtn = contentForm.querySelector('.next-btn');

      contentOptions.forEach(option => {

        if (userPreferences.content === option.getAttribute('data-content')) {

          option.classList.add('selected');

          contentInput.value = userPreferences.content;

          contentBtn.disabled = false;

        }

        option.addEventListener('click', () => {

          contentOptions.forEach(opt => opt.classList.remove('selected'));

          option.classList.add('selected');

          contentInput.value = option.getAttribute('data-content');

          contentBtn.disabled = false;

        });

      });

      contentForm.addEventListener('submit', (e) => {

        e.preventDefault();

        const formData = new FormData(contentForm);

        fetch(window.location.href, {

          method: 'POST',

          body: formData

        }).then(() => {

          window.location.href = '/learning';

        });

      });

    });

  </script>

</body>

</html>