<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sound Effects</title>
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
      --gray-light: #e9ecef;
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
      background: rgba(18, 52, 88, 0.05);
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
      padding: 1.5rem;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 2rem;
      animation: fadeIn 0.5s ease-out;
      display: flex;
      flex-direction: column;
    }

    .content-header h1 {
      color: var(--dark);
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .content-header p {
      color: var(--gray);
      font-size: 1rem;
    }

    /* Search Bar Styles */
    .search-container {
      position: relative;
      max-width: 400px;
      margin-top: 0.5rem;
    }

    .search-container input {
      width: 100%;
      padding: 0.75rem 1rem 0.75rem 2.5rem;
      border: 1px solid var(--gray-light);
      border-radius: 0.5rem;
      font-size: 0.9rem;
      transition: var(--transition);
      background: var(--light);
    }

    .search-container input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(18, 52, 88, 0.1);
    }

    .search-container i {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
      font-size: 1rem;
    }

    /* Explore Button */
    .btn-explore {
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 0.7rem 1.5rem;
      border-radius: 0.3rem;
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
      font-weight: 500;
      text-decoration: none;
      align-self: flex-start;
      margin-top: 0.5rem;
    }

    .btn-explore:hover {
      background-color: var(--primary-dark);
    }

    /* Generate Section */
    .generate-section {
      background: white;
      padding: 1.5rem;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 2rem;
      animation: fadeIn 0.5s ease-out;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .tag-cloud {
      width: 100%;
      max-width: 800px;
      margin-bottom: 1rem;
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      justify-content: center;
    }

    .tag-cloud span {
      display: inline-block;
      padding: 0.5rem 1rem;
      border-radius: 1rem;
      color: white;
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
      font-weight: 500;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      background: var(--primary);
    }

    .tag-cloud span:hover {
      transform: scale(1.05);
      filter: brightness(1.2);
      box-shadow: 0 4px 8px rgba(18, 52, 88, 0.3);
    }

    .tag-cloud span.selected {
      filter: brightness(1.4);
      transform: scale(1.1);
      animation: pulse 0.3s ease;
    }

    .tag-cloud span.weight-1 { font-size: 0.8rem; }
    .tag-cloud span.weight-2 { font-size: 0.9rem; }
    .tag-cloud span.weight-3 { font-size: 1rem; }
    .tag-cloud span.weight-4 { font-size: 1.1rem; }
    .tag-cloud span.weight-5 { font-size: 1.2rem; }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.15); }
      100% { transform: scale(1.05); }
    }

    .generate-controls {
      background: var(--light);
      padding: 1rem;
      border-radius: 0.5rem;
      width: 100%;
      max-width: 600px;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .generate-field {
      position: relative;
    }

    .generate-field input[type="text"] {
      width: 100%;
      padding: 0.7rem 1rem 0.7rem 2.5rem;
      border: 1px solid var(--gray-light);
      border-radius: 0.3rem;
      font-size: 0.9rem;
      transition: var(--transition);
    }

    .generate-field input[type="text"]:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(18, 52, 88, 0.1);
    }

    .generate-field i {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
      font-size: 1rem;
    }

    .slider-container {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .slider-container label {
      font-size: 0.9rem;
      color: var(--gray);
      min-width: 60px;
    }

    .slider-container input[type="range"] {
      flex: 1;
    }

    .slider-container input[type="range"]:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .slider-container span {
      font-size: 0.9rem;
      color: var(--dark);
    }

    .toggle-container {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-left: 0.5rem;
    }

    .toggle-container span {
      font-size: 0.9rem;
      color: var(--gray);
    }

    .toggle-label {
      display: inline-block;
      width: 48px;
      height: 24px;
      position: relative;
      cursor: pointer;
      -webkit-tap-highlight-color: transparent;
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
    }

    .toggle-slider {
      position: absolute;
      top: 0;
      left: 0;
      width: 48px;
      height: 24px;
      background: var(--gray);
      border-radius: 24px;
      transition: var(--transition);
    }

    .toggle-slider:before {
      content: '';
      position: absolute;
      top: 3px;
      left: 3px;
      width: 18px;
      height: 18px;
      background: white;
      border-radius: 50%;
      transition: var(--transition);
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .toggle-label.active .toggle-slider {
      background: var(--primary);
    }

    .toggle-label.active .toggle-slider:before {
      transform: translateX(24px);
    }

    /* Responsivitas untuk layar kecil */
    @media (max-width: 768px) {
      .toggle-label {
        width: 48px;
        height: 24px;
      }

      .toggle-slider {
        width: 48px;
        height: 24px;
      }

      .toggle-slider:before {
        top: 3px;
        left: 3px;
        width: 18px;
        height: 18px;
      }

      .toggle-label.active .toggle-slider:before {
        transform: translateX(24px);
      }
    }

    .dropdown-container {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .dropdown-container label {
      font-size: 0.9rem;
      color: var(--gray);
      min-width: 60px;
    }

    .dropdown-container select {
      padding: 0.5rem;
      border: 1px solid var(--gray-light);
      border-radius: 0.3rem;
      font-size: 0.9rem;
      transition: var(--transition);
    }

    .dropdown-container select:focus {
      outline: none;
      border-color: var(--primary);
    }

    .btn-generate {
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 0.7rem 1.5rem;
      border-radius: 0.3rem;
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-generate:hover {
      background-color: var(--primary-dark);
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

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .tag-cloud {
        gap: 0.3rem;
      }

      .tag-cloud span {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
      }

      .tag-cloud span.weight-1 { font-size: 0.7rem; }
      .tag-cloud span.weight-2 { font-size: 0.8rem; }
      .tag-cloud span.weight-3 { font-size: 0.9rem; }
      .tag-cloud span.weight-4 { font-size: 1rem; }
      .tag-cloud span.weight-5 { font-size: 1.1rem; }

      .generate-controls {
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
        <li><a href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="/notification"><i class="fas fa-bell"></i> Notification</a></li>
        <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>

        <li class="category">Voice Tools</li>
        <li><a href="/voice-library"><i class="fas fa-volume-up"></i> Voice Library</a></li>
        <li><a href="/text-to-speech"><i class="fas fa-font"></i> Text to Speech</a></li>
        <li><a href="/voice-changer"><i class="fas fa-microphone-alt"></i> Voice Changer</a></li>
        <li><a href="/studio"><i class="fas fa-microphone"></i> Studio</a></li>
        <li><a href="/dubbing-room"><i class="fas fa-record-vinyl"></i> Dubbing Room</a></li>

        <li class="category">Audio Tools</li>
        <li><a href="/sound-effects" class="active"><i class="fas fa-headphones"></i> Sound Effects</a></li>
        <li><a href="/audio-tools"><i class="fas fa-tools"></i> Audio Tools</a></li>

        <li class="category">AI Features</li>
        <li><a href="/conversational-ai"><i class="fas fa-comments"></i> Conversational AI</a></li>
        <li><a href="/speech-to-text"><i class="fas fa-microphone-alt-slash"></i> Speech to Text</a></li>
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="content-header">
      <h1>Sound Effects</h1>
      <p>Generate and explore our collection of sound effects to enhance your projects.</p>
      <div class="search-container">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search sound effects...">
      </div>
      <a href="/explore" class="btn-explore">Explore More Sounds</a>
    </div>

    <!-- Generate Sound Effect Section -->
    <div class="generate-section">
      <div class="tag-cloud" id="tag-cloud"></div>
      <div class="generate-controls">
        <div class="generate-field">
          <i class="fas fa-microphone"></i>
          <input type="text" id="sound-description" placeholder="Describe a sound...">
        </div>
        <div class="slider-container">
          <label for="duration">Duration:</label>
          <input type="range" id="duration" min="1" max="30" value="8">
          <span id="duration-value">8s</span>
          <div class="toggle-container">
            <span>Auto:</span>
            <div class="toggle-label" id="auto-duration">
              <span class="toggle-slider"></span>
            </div>
          </div>
        </div>
        <div class="slider-container">
          <label for="volume">Volume:</label>
          <input type="range" id="volume" min="0" max="100" value="30">
          <span id="volume-value">30%</span>
        </div>
        <div class="dropdown-container">
          <label for="sample-rate">Sample Rate:</label>
          <select id="sample-rate">
            <option value="320/10000">320 / 10,000</option>
            <option value="44100">44,100</option>
            <option value="48000">48,000</option>
          </select>
        </div>
        <button class="btn-generate">
          <i class="fas fa-microphone"></i> Generate
        </button>
      </div>
    </div>
  </div>

  <script>
    // Smooth hover effect with delay for sidebar
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

    // Tag cloud for sound effect suggestions
    const tagList = [
      { text: 'Intense cinematic boom', weight: 5 },
      { text: 'Huge epic brass', weight: 4 },
      { text: 'Horses gallop', weight: 4 },
      { text: 'Cat purr', weight: 3 },
      { text: 'Rock slide', weight: 3 },
      { text: 'Tortoise footstep', weight: 2 },
      { text: 'Semi-automatic weapon', weight: 2 },
      { text: 'Truck reversing', weight: 2 },
      { text: 'Small propeller airplane', weight: 1 },
      { text: 'Mopping a floor', weight: 1 },
      { text: 'Big bass lute', weight: 1 },
      { text: 'V4 deep bass', weight: 1 },
      { text: 'Footsteps in mud', weight: 1 },
      { text: 'AC buzz', weight: 1 }
    ];

    const tagCloud = document.getElementById('tag-cloud');
    const monochromeColors = [
      '#123458', // Base: --primary
      '#0e2b47', // Darker
      '#0a2236', // Darkest
      '#2a4b7c', // Lighter
      '#4262a0'  // Lightest
    ];

    // Generate tag cloud
    tagList.forEach(tag => {
      const span = document.createElement('span');
      span.textContent = tag.text;
      span.className = `weight-${tag.weight}`;
      span.style.background = monochromeColors[Math.floor(Math.random() * monochromeColors.length)];
      span.style.color = 'white';
      span.addEventListener('click', () => {
        document.getElementById('sound-description').value = tag.text;
        tagCloud.querySelectorAll('span').forEach(s => s.classList.remove('selected'));
        span.classList.add('selected');
        setTimeout(() => span.classList.remove('selected'), 300);
      });
      tagCloud.appendChild(span);
    });

    // Update slider values
    const durationSlider = document.getElementById('duration');
    const durationValue = document.getElementById('duration-value');
    const volumeSlider = document.getElementById('volume');
    const volumeValue = document.getElementById('volume-value');
    const autoDurationToggle = document.getElementById('auto-duration');
    let isAutoActive = false;

    durationSlider.addEventListener('input', () => {
      durationValue.textContent = `${durationSlider.value}s`;
    });

    volumeSlider.addEventListener('input', () => {
      volumeValue.textContent = `${volumeSlider.value}%`;
    });

    function handleToggleChange() {
      isAutoActive = !isAutoActive;
      autoDurationToggle.classList.toggle('active', isAutoActive);
      console.log('Toggle changed:', isAutoActive);
      if (isAutoActive) {
        durationSlider.value = 8;
        durationSlider.disabled = true;
        durationValue.textContent = '8s';
      } else {
        durationSlider.disabled = false;
      }
    }

    autoDurationToggle.addEventListener('click', handleToggleChange);
    autoDurationToggle.addEventListener('touchstart', (e) => {
      e.preventDefault();
      handleToggleChange();
    });
  </script>
</body>
</html>