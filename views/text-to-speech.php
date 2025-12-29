<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Text to Speech</title>
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
      --gray-light: #e2e8f0; /* Added to match Voice Library */
      --success: #4cc9f0;
      --warning: #f8961e;
      --danger: #f72585;
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
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
      padding: 1.5rem;
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
      background-color: white;
      padding: 1.5rem;
      border-radius: 0.75rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      animation: fadeIn 0.5s ease-out;
    }

    .content-header h1 {
      color: var(--dark);
      font-size: 1.8rem;
      font-weight: 600;
    }

    .content-header p {
      color: var(--gray);
      font-size: 0.95rem;
    }

    .content-header i {
      color: var(--primary);
      font-size: 1.8rem;
    }

    .content-body {
      background-color: white;
      padding: 1.5rem;
      border-radius: 0.75rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      animation: fadeIn 0.5s ease-out;
    }

    /* Input Text Section */
    .input-section {
      margin-bottom: 2rem;
    }

    .input-section label {
      display: block;
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .input-section textarea {
      width: 100%;
      padding: 0.7rem;
      border: 1px solid var(--gray-light);
      border-radius: 0.3rem;
      font-size: 0.9rem;
      resize: vertical;
      min-height: 120px;
      transition: var(--transition);
    }

    .input-section textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(18, 52, 88, 0.1);
    }

    .input-section .btn {
      margin-top: 1rem;
    }

    /* Button Styles */
    .btn {
      padding: 0.7rem 1.5rem;
      border: none;
      border-radius: 0.3rem;
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .btn-primary {
      background-color: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background-color: var(--primary-dark);
    }

    .btn-primary:disabled {
      background-color: #a3bffa;
      cursor: not-allowed;
    }

    /* Voice Selection */
    .voice-section {
      margin-bottom: 2rem;
    }

    .voice-section label {
      display: block;
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .dropdown {
      position: relative;
      width: 100%;
      max-width: 300px;
    }

    .dropdown-toggle {
      width: 100%;
      padding: 0.7rem;
      border: 1px solid var(--gray-light);
      border-radius: 0.3rem;
      font-size: 0.9rem;
      background-color: white;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: var(--transition);
    }

    .dropdown-toggle:hover,
    .dropdown-toggle:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(18, 52, 88, 0.1);
      outline: none;
    }

    .dropdown-toggle::after {
      content: '\f078';
      font-family: 'Font Awesome 5 Free';
      font-weight: 900;
      font-size: 0.7rem;
      color: var(--gray);
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background-color: white;
      border: 1px solid var(--gray-light);
      border-radius: 0.3rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      list-style: none;
      margin: 0;
      padding: 0;
      display: none;
      z-index: 1400;
      max-height: 200px;
      overflow-y: auto;
    }

    .dropdown-menu.show {
      display: block;
      animation: slideDown 0.2s ease-out;
    }

    .dropdown-menu li {
      padding: 0.7rem;
      font-size: 0.9rem;
      color: var(--dark);
      cursor: pointer;
      transition: var(--transition);
    }

    .dropdown-menu li:hover {
      background-color: rgba(18, 52, 88, 0.05);
      color: var(--primary);
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-5px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Output Section */
    .output-section {
      margin-bottom: 2rem;
    }

    .output-section label {
      display: block;
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .output-section audio {
      width: 100%;
      max-width: 300px;
      border-radius: 0.3rem;
      margin-top: 0.5rem;
    }

    .output-placeholder {
      color: var(--gray);
      font-size: 0.9rem;
      padding: 0.7rem;
      border: 1px dashed var(--gray-light);
      border-radius: 0.3rem;
      text-align: center;
    }

    /* Notification */
    .notification {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: var(--success);
      color: white;
      padding: 1rem;
      border-radius: 0.3rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      display: none;
      z-index: 1300;
    }

    .notification.show {
      display: block;
    }

    .notification.error {
      background-color: var(--danger);
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
      width: 6px;
    }

    ::-webkit-scrollbar-track {
      background: var(--gray-light);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--primary);
      border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--primary-dark);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .dropdown,
      .output-section audio {
        max-width: 100%;
      }
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
        <li><a href="/text-to-speech" class="active"><i class="fas fa-font"></i> Text to Speech</a></li>
        <li><a href="/voice-changer"><i class="fas fa-microphone-alt"></i> Voice Changer</a></li>
        <li><a href="/studio"><i class="fas fa-microphone"></i> Studio</a></li>
        <li><a href="/dubbing-room"><i class="fas fa-record-vinyl"></i> Dubbing Room</a></li>

        <li class="category">Audio Tools</li>
        <li><a href="/sound-effects"><i class="fas fa-headphones"></i> Sound Effects</a></li>
        <li><a href="/audio-tools"><i class="fas fa-tools"></i> Audio Tools</a></li>

        <li class="category">AI Features</li>
        <li><a href="/conversational-ai"><i class="fas fa-comments"></i> Conversational AI</a></li>
        <li><a href="/speech-to-text"><i class="fas fa-microphone-alt-slash"></i> Speech to Text</a></li>
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="main">
    <div class="content-header">
      <i class="fas fa-font"></i>
      <div>
        <h1>Text to Speech</h1>
        <p>Convert your text into natural-sounding speech.</p>
      </div>
    </div>
    <div class="content-body">
      <div class="input-section">
        <label for="textInput">Input Text</label>
        <textarea id="textInput" rows="5" placeholder="Type your text here..."></textarea>
        <button class="btn btn-primary" id="convertBtn">Convert to Speech</button>
      </div>

      <div class="voice-section">
        <label for="voiceSelect">Available Voices</label>
        <div class="dropdown">
          <button class="dropdown-toggle" id="voiceSelect">English (US)</button>
          <ul class="dropdown-menu" id="voiceMenu">
            <li data-value="en-US">English (US)</li>
            <li data-value="en-GB">English (UK)</li>
            <li data-value="es-ES">Spanish (Spain)</li>
            <li data-value="fr-FR">French (France)</li>
            <li data-value="de-DE">German (Germany)</li>
          </ul>
        </div>
      </div>

      <div class="output-section">
        <label>Output</label>
        <div id="outputPlaceholder" class="output-placeholder">No audio generated yet.</div>
        <audio id="audioOutput" controls style="display: none;"></audio>
      </div>
    </div>
  </div>

  <!-- Notification -->
  <div class="notification" id="notification"></div>

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

    // Text to Speech functionality
    const convertBtn = document.getElementById('convertBtn');
    const textInput = document.getElementById('textInput');
    const audioOutput = document.getElementById('audioOutput');
    const voiceSelect = document.getElementById('voiceSelect');
    const voiceMenu = document.getElementById('voiceMenu');
    const outputPlaceholder = document.getElementById('outputPlaceholder');
    const notification = document.getElementById('notification');
    let currentVoice = 'en-US';

    function showNotification(message, type = 'success') {
      notification.textContent = message;
      notification.className = `notification show ${type}`;
      setTimeout(() => {
        notification.classList.remove('show');
      }, 3000);
    }

    convertBtn.addEventListener('click', () => {
      const text = textInput.value.trim();
      if (text) {
        convertBtn.disabled = true;
        convertBtn.textContent = 'Converting...';
        const speech = new SpeechSynthesisUtterance(text);
        speech.lang = currentVoice;
        speech.onend = () => {
          convertBtn.disabled = false;
          convertBtn.textContent = 'Convert to Speech';
          showNotification('Text converted successfully!');
        };
        speechSynthesis.speak(speech);
        outputPlaceholder.style.display = 'none';
        audioOutput.style.display = 'block';
      } else {
        showNotification('Please enter some text to convert.', 'error');
      }
    });

    // Dropdown Handling
    voiceSelect.addEventListener('click', () => {
      voiceMenu.classList.toggle('show');
    });

    voiceMenu.querySelectorAll('li').forEach(item => {
      item.addEventListener('click', () => {
        currentVoice = item.dataset.value;
        voiceSelect.textContent = item.textContent;
        voiceMenu.classList.remove('show');
      });
    });

    document.addEventListener('click', (e) => {
      if (!voiceSelect.contains(e.target) && !voiceMenu.contains(e.target)) {
        voiceMenu.classList.remove('show');
      }
    });
  </script>
</body>
</html>