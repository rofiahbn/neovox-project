<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Audio Tools - Dashboard</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root {
      --primary: #123458;
      --primary-dark: #3a56d4;
      --secondary: #3f37c9;
      --dark: #1a1a2e;
      --light: #f8f9fa;
      --gray: #6c757d;
      --success: #4cc9f0;
      --warning: #f8961e;
      --danger: #f72585;
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
      line-height: 1.6;
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
      transition: var(--transition);
    }

    .header:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
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

    /* Content Styles */
    .content-header {
      background: white;
      padding: 1.5rem;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 2rem;
      animation: fadeIn 0.5s ease-out;
    }

    .content-header h1 {
      color: var(--dark);
      font-size: 2rem;
      margin-bottom: 0.5rem;
      font-weight: 700;
    }

    .content-header p {
      color: var(--gray);
      font-size: 1rem;
    }

    .content-body {
      background: white;
      padding: 1.5rem;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      animation: fadeIn 0.5s ease-out;
    }

    .content-body p {
      margin-bottom: 1rem;
      color: #334155;
      font-size: 0.95rem;
    }

    /* Audio Tools Grid */
    .tools-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-top: 1.5rem;
    }

    .tool-card {
      background: white;
      border-radius: 0.75rem;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: var(--transition);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .tool-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .tool-card-header {
      padding: 1.25rem;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      display: flex;
      align-items: center;
    }

    .tool-card-header i {
      font-size: 1.5rem;
      margin-right: 0.75rem;
    }

    .tool-card-body {
      padding: 1.25rem;
    }

    .tool-card-body h3 {
      margin-bottom: 0.75rem;
      color: var(--dark);
    }

    .tool-card-body p {
      color: var(--gray);
      font-size: 0.9rem;
      margin-bottom: 1.25rem;
    }

    .btn {
      display: inline-block;
      padding: 0.5rem 1rem;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 0.5rem;
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
      cursor: pointer;
      font-size: 0.85rem;
    }

    .btn:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
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

  <!-- Hover Zone -->
  <div class="hover-zone">
    <!-- Header -->
    <div class="header">
      <!-- Sidebar toggle button -->
      <button class="toggle-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Logo -->
      <a href="/dashboard">
        <img src="img/logoNeovox.png" alt="Logo" style="height: 35px">
      </a>
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
        <li><a href="/dubbing-room"><i class="fas fa-record-vinyl"></i> Dubbing Room</a></li>

        <li class="category">Audio Tools</li>
        <li><a href="/sound-effects"><i class="fas fa-headphones"></i> Sound Effects</a></li>
        <li><a href="/audio-tools" class="active"><i class="fas fa-tools"></i> Audio Tools</a></li>

        <li class="category">AI Features</li>
        <li><a href="/conversational-ai"><i class="fas fa-comments"></i> Conversational AI</a></li>
        <li><a href="/speech-to-text"><i class="fas fa-microphone-alt-slash"></i> Speech to Text</a></li>
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="main">
    <div class="content-header">
      <h1>Audio Tools</h1>
      <p>Enhance and transform your audio with our powerful tools</p>
    </div>
    <div class="content-body">
      <p>Select an audio tool to get started. Each tool offers unique capabilities to improve your audio projects.</p>
      
      <div class="tools-grid">
        <!-- Audio Native Card -->
        <div class="tool-card">
          <div class="tool-card-header">
            <i class="fas fa-wave-square"></i>
            <h2>Audio Native</h2>
          </div>
          <div class="tool-card-body">
            <h3>Native Audio Processing</h3>
            <p>High-quality audio processing with native performance. Optimized for clean, natural sound output.</p>
            <a href="/audio-tools/native" class="btn">Open Tool</a>
          </div>
        </div>
        
        <!-- Voiceover Studio Card -->
        <div class="tool-card">
          <div class="tool-card-header">
            <i class="fas fa-microphone"></i>
            <h2>Voiceover Studio</h2>
          </div>
          <div class="tool-card-body">
            <h3>Professional Voice Recording</h3>
            <p>Record, edit and enhance voiceovers with studio-quality effects and real-time processing.</p>
            <a href="/audio-tools/voiceover-studio" class="btn">Open Tool</a>
          </div>
        </div>
        
        <!-- Voice Isolator Card -->
        <div class="tool-card">
          <div class="tool-card-header">
            <i class="fas fa-user-secret"></i>
            <h2>Voice Isolator</h2>
          </div>
          <div class="tool-card-body">
            <h3>Isolate Voices from Noise</h3>
            <p>Remove background noise and extract clear voice audio from any recording with AI-powered isolation.</p>
            <a href="/audio-tools/voice-isolator" class="btn">Open Tool</a>
          </div>
        </div>
        
        <!-- AI Speech Classifier Card -->
        <div class="tool-card">
          <div class="tool-card-header">
            <i class="fas fa-brain"></i>
            <h2>AI Speech Classifier</h2>
          </div>
          <div class="tool-card-body">
            <h3>Advanced Speech Analysis</h3>
            <p>Analyze and classify speech patterns, emotions, and characteristics using artificial intelligence.</p>
            <a href="/audio-tools/ai-classifier" class="btn">Open Tool</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Smooth hover effect with delay
    const hoverZone = document.querySelector('.hover-zone');
    let hoverTimer;
    
    hoverZone.addEventListener('mouseenter', () => {
      clearTimeout(hoverTimer);
      hoverZone.classList.add('hover-active');
    });
    
    hoverZone.addEventListener('mouseleave', () => {
      hoverTimer = setTimeout(() => {
        hoverZone.classList.remove('hover-active');
      }, 300);
    });
  </script>
</body>
</html>