<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dubbing Room</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root {
      --primary: #123458;
      --primary-dark: #3a56d4;
      --secondary: #3f37c9;
      --dark: #1a1a2e;
      --light: #f8f9fa;
      --gray: #6c757d;
      --gray-light: #e9ecef;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(180deg, #f8fafc 0%, #e9ecef 100%);
      color: var(--dark);
      overflow-x: hidden;
    }

    /* Header Styles */
    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      padding: 0.8rem 1.5rem;
      display: flex;
      align-items: center;
      z-index: 1000;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Sidebar Trigger Wrapper */
    .hover-zone {
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      width: 60px;
      z-index: 1100;
      transition: var(--transition);
    }

    /* Sidebar Styles */
    .sidebar {
      position: fixed;
      left: -250px;
      top: 0;
      bottom: 0;
      width: 250px;
      background: white;
      color: var(--dark);
      padding-top: 4.5rem;
      transition: var(--transition);
      z-index: 900;
      overflow-y: auto;
      box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
      border-right: 1px solid var(--gray-light);
    }

    .hover-zone:hover {
      width: 250px;
    }

    .hover-zone:hover .sidebar {
      left: 0;
    }

    .hover-zone:hover ~ .main-content {
      margin-left: 250px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li a {
      color: var(--gray);
      text-decoration: none;
      display: flex;
      align-items: center;
      padding: 0.8rem 1.5rem;
      transition: var(--transition);
      font-size: 0.85rem;
      font-weight: 500;
      border-left: 3px solid transparent;
    }

    .sidebar ul li.category {
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      color: var(--gray);
      text-transform: uppercase;
      font-size: 0.7rem;
      letter-spacing: 1.2px;
    }

    .sidebar ul li + li.category {
      margin-top: 1.5rem;
    }

    .sidebar ul li a:hover {
      color: var(--primary);
      background: rgba(18, 52, 88, 0.05);
      border-left: 3px solid var(--primary);
      transform: translateX(5px);
    }

    .sidebar ul li a.active {
      color: var(--primary);
      background: rgba(18, 52, 88, 0.1);
      border-left: 3px solid var(--primary);
    }

    .sidebar ul li a i {
      width: 24px;
      text-align: center;
      margin-right: 12px;
      font-size: 1.1rem;
      color: var(--primary);
    }

    /* Main Content Styles */
    .main-content {
      margin-top: 4.5rem;
      padding: 2.5rem;
      transition: var(--transition);
      min-height: calc(100vh - 4.5rem);
    }

    /* Toggle Button Styles */
    .toggle-btn {
      background-color: transparent;
      color: white;
      border: none;
      padding: 0.5rem;
      cursor: pointer;
      font-size: 1.5rem;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: var(--transition);
      margin-right: 0.5rem;
    }

    .toggle-btn:hover {
      background-color: rgba(255, 255, 255, 0.15);
      transform: rotate(90deg);
    }

    /* Content Header Styles */
    .content-header {
      background: white;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 2rem;
      animation: fadeIn 0.5s ease-out;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .content-header h1 {
      color: var(--dark);
      font-size: 2rem;
      font-weight: 700;
    }

    .content-header p {
      color: var(--gray);
      font-size: 1rem;
      margin-top: 0.5rem;
    }

    .content-header button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
    }

    .content-header button:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    /* Learn Section */
    .learn-section {
      margin-bottom: 2rem;
    }

    .learn-section h2 {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .learn-section p {
      color: var(--gray);
      font-size: 1rem;
      margin-bottom: 1.5rem;
    }

    .video-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
    }

    .video-card {
      background: white;
      padding: 1rem;
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      transition: var(--transition);
      animation: slideUp 0.5s ease-out;
      animation-delay: calc(0.1s * var(--i));
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .video-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .video-card .thumbnail {
      position: relative;
      flex: 0 0 120px;
      height: 80px;
      background: var(--gray-light);
      border-radius: 0.5rem;
      overflow: hidden;
    }

    .video-card .thumbnail i {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 2rem;
      color: var(--primary);
      opacity: 0.8;
    }

    .video-card .thumbnail:hover i {
      opacity: 1;
    }

    .video-card h3 {
      font-size: 1rem;
      font-weight: 500;
      color: var(--dark);
      margin-bottom: 0.25rem;
    }

    .video-card p {
      font-size: 0.85rem;
      color: var(--gray);
      margin: 0;
    }

    /* Translate Section */
    .translate-section {
      background: white;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      animation: fadeIn 0.5s ease-out;
      position: relative;
      overflow: hidden;
    }

    .translate-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('https://via.placeholder.com/1200x300.png?text=Background+Image') no-repeat center/cover;
      opacity: 0.1;
      z-index: 0;
    }

    .translate-section .content {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .translate-section i {
      font-size: 2.5rem;
      color: var(--primary);
    }

    .translate-section h2 {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .translate-section p {
      color: var(--gray);
      font-size: 1rem;
      margin-bottom: 1.5rem;
    }

    .translate-section button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
    }

    .translate-section button:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: var(--gray-light);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--primary);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--primary-dark);
    }
  </style>
</head>
<body>
  <div class="hover-zone">
    <div class="header">
      <button class="toggle-btn"><i class="fas fa-bars"></i></button>
      <a href="/dashboard"><img src="img/logoNeovox.png" alt="Logo" style="height: 35px;"></a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <ul>
        <li class="category">Main Menu</li>
        <li><a href="/dashboard"><i class="fas fa-bell"></i> Dashboard</a></li>
        <li><a href="/notification"><i class="fas fa-bell"></i> Notification</a></li>
        <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>

        <li class="category">Voice Tools</li>
        <li><a href="/voice-library"><i class="fas fa-volume-up"></i> Voice Library</a></li>
        <li><a href="/text-to-speech"><i class="fas fa-font"></i> Text to Speech</a></li>
        <li><a href="/voice-changer"><i class="fas fa-microphone-alt"></i> Voice Changer</a></li>
        <li><a href="/studio"><i class="fas fa-microphone"></i> Studio</a></li>
        <li><a href="/dubbing-room" class="active"><i class="fas fa-record-vinyl"></i> Dubbing Room</a></li>

        <li class="category">Audio Tools</li>
        <li><a href="/sound-effects"><i class="fas fa-headphones"></i> Sound Effects</a></li>
        <li><a href="/audio-tools"><i class="fas fa-tools"></i> Audio Tools</a></li>

        <li class="category">AI Features</li>
        <li><a href="/conversational-ai"><i class="fas fa-comments"></i> Conversational AI</a></li>
        <li><a href="/speech-to-text"><i class="fas fa-microphone-alt-slash"></i> Speech to Text</a></li>
      </ul>
    </div>
  </div>

  <div class="main-content">
    <div class="content-header">
      <div>
        <h1>Dubbing</h1>
        <p>Localize content across 29 languages with AI dubbing.</p>
      </div>
      <button>Create a Dub</button>
    </div>

    <div class="learn-section">
      <h2>Learn</h2>
      <p>Watch our short video guides to help you get up to speed with dubbing your content.</p>
      <div class="video-cards">
        <div class="video-card" style="--i: 1;">
          <div class="thumbnail">
            <i class="fas fa-play-circle"></i>
          </div>
          <div>
            <h3>Learn about the Dubbing editor</h3>
            <p>A professional editor app that makes it easy to precisely dub content with ultimate control.</p>
          </div>
        </div>
        <div class="video-card" style="--i: 2;">
          <div class="thumbnail">
            <i class="fas fa-play-circle"></i>
          </div>
          <div>
            <h3>Importing YouTube videos</h3>
            <p>Discover how to easily dub any YouTube video for easy sharing.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="translate-section">
      <div class="content">
        <i class="fas fa-globe"></i>
        <div>
          <h2>Translate your content into 29 languages</h2>
          <p>Create video and audio dubs with authentic accents and expressions, helping you connect with audiences everywhere.</p>
          <button>Start Dubbing</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>