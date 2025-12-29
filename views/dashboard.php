<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link rel="icon" href="/img/logoNeovox.png" type="image/png" sizes="any">
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

    /* Dashboard Grid Layout */
    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
    }

    .dashboard-card {
      background: white;
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transition: var(--transition);
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .card-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--primary);
    }

    .card-icon {
      width: 40px;
      height: 40px;
      background: rgba(18, 52, 88, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
    }

    .voice-card {
      border-left: 4px solid var(--success);
    }

    .creation-card {
      border-left: 4px solid var(--warning);
    }

    .library-card {
      border-left: 4px solid var(--primary);
    }

    .voice-item {
      display: flex;
      align-items: center;
      padding: 0.75rem 0;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .voice-item:last-child {
      border-bottom: none;
    }

    .voice-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--light);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      color: var(--primary);
      font-weight: 600;
    }

    .voice-info {
      flex: 1;
    }

    .voice-name {
      font-weight: 600;
      margin-bottom: 0.25rem;
    }

    .voice-desc {
      font-size: 0.85rem;
      color: var(--gray);
    }

    .creation-option {
      display: flex;
      align-items: center;
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 0.75rem;
      background: rgba(248, 249, 250, 0.5);
      transition: var(--transition);
      cursor: pointer;
    }

    .creation-option:hover {
      background: rgba(18, 52, 88, 0.05);
    }

    .creation-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(18, 52, 88, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      color: var(--warning);
    }

    .creation-details {
      flex: 1;
    }

    .creation-title {
      font-weight: 600;
      margin-bottom: 0.25rem;
    }

    .creation-desc {
      font-size: 0.85rem;
      color: var(--gray);
    }

    .greeting-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .greeting-text h2 {
      font-size: 1.5rem;
      color: var(--dark);
      margin-bottom: 0.25rem;
    }

    .greeting-text p {
      color: var(--gray);
    }

    .time-indicator {
      background: rgba(18, 52, 88, 0.1);
      padding: 0.5rem 1rem;
      border-radius: 2rem;
      font-size: 0.85rem;
      color: var(--primary);
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
      background: #f1f1f1;
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
        <li><a href="/dashboard" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
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
      <div class="greeting-section">
        <div class="greeting-text">
          <h2>Welcome to Voice Studio</h2>
          <p>Good afternoon, Rofi'ah</p>
        </div>
        <div class="time-indicator">
          <i class="fas fa-clock"></i> Afternoon Session
        </div>
      </div>
    </div>
    
    <div class="content-body">
      <div class="dashboard-grid">
        <!-- Quick Actions Card -->
        <div class="dashboard-card creation-card">
          <div class="card-header">
            <h3 class="card-title">Voice Creation</h3>
            <div class="card-icon">
              <i class="fas fa-magic"></i>
            </div>
          </div>
          
          <div class="creation-option">
            <div class="creation-icon">
              <i class="fas fa-pencil-ruler"></i>
            </div>
            <div class="creation-details">
              <div class="creation-title">Voice Design</div>
              <div class="creation-desc">Craft a unique voice from scratch</div>
            </div>
          </div>
          
          <div class="creation-option">
            <div class="creation-icon">
              <i class="fas fa-clone"></i>
            </div>
            <div class="creation-details">
              <div class="creation-title">Voice Cloning</div>
              <div class="creation-desc">Replicate your own voice digitally</div>
            </div>
          </div>
          
          <div class="creation-option">
            <div class="creation-icon">
              <i class="fas fa-layer-group"></i>
            </div>
            <div class="creation-details">
              <div class="creation-title">Voice Collections</div>
              <div class="creation-desc">Explore curated voice libraries</div>
            </div>
          </div>
        </div>
        
        <!-- Voice Library Card -->
        <div class="dashboard-card library-card">
          <div class="card-header">
            <h3 class="card-title">Your Voice Library</h3>
            <div class="card-icon">
              <i class="fas fa-book-open"></i>
            </div>
          </div>
          
          <div class="voice-item">
            <div class="voice-avatar">P</div>
            <div class="voice-info">
              <div class="voice-name">Putra</div>
              <div class="voice-desc">Energetic Indonesian male voice with vibrant tone</div>
            </div>
          </div>
          
          <div class="voice-item">
            <div class="voice-avatar">M</div>
            <div class="voice-info">
              <div class="voice-name">Mahaputra</div>
              <div class="voice-desc">Clear and steady professional narration voice</div>
            </div>
          </div>
          
          <div class="voice-item">
            <div class="voice-avatar">A</div>
            <div class="voice-info">
              <div class="voice-name">Andi</div>
              <div class="voice-desc">Confident and articulate business voice</div>
            </div>
          </div>
          
          <div class="voice-item">
            <div class="voice-avatar">J</div>
            <div class="voice-info">
              <div class="voice-name">Jessica</div>
              <div class="voice-desc">Friendly and approachable customer service voice</div>
            </div>
          </div>
        </div>
        
        <!-- Quick Access Card -->
        <div class="dashboard-card voice-card">
          <div class="card-header">
            <h3 class="card-title">Quick Access</h3>
            <div class="card-icon">
              <i class="fas fa-bolt"></i>
            </div>
          </div>
          
          <div class="voice-item">
            <div class="voice-avatar" style="background-color: rgba(76, 201, 240, 0.1); color: var(--success);">
              <i class="fas fa-book"></i>
            </div>
            <div class="voice-info">
              <div class="voice-name">Audiobook Narration</div>
              <div class="voice-desc">Professional narration presets</div>
            </div>
          </div>
          
          <div class="voice-item">
            <div class="voice-avatar" style="background-color: rgba(248, 150, 30, 0.1); color: var(--warning);">
              <i class="fas fa-robot"></i>
            </div>
            <div class="voice-info">
              <div class="voice-name">AI Agent Voices</div>
              <div class="voice-desc">Virtual assistant presets</div>
            </div>
          </div>
          
          <div class="voice-item">
            <div class="voice-avatar" style="background-color: rgba(247, 37, 133, 0.1); color: var(--danger);">
              <i class="fas fa-ad"></i>
            </div>
            <div class="voice-info">
              <div class="voice-name">Commercial Voices</div>
              <div class="voice-desc">Advertising and marketing presets</div>
            </div>
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

    // Update greeting based on time of day
    function updateGreeting() {
      const hour = new Date().getHours();
      const greeting = document.querySelector('.greeting-text h2');
      const timeIndicator = document.querySelector('.time-indicator');
      
      if (hour < 12) {
        greeting.textContent = "Good Morning";
        timeIndicator.innerHTML = '<i class="fas fa-sun"></i> Morning Session';
      } else if (hour < 18) {
        greeting.textContent = "Good Afternoon!";
        timeIndicator.innerHTML = '<i class="fas fa-clock"></i> Afternoon Session';
      } else {
        greeting.textContent = "Good Evening";
        timeIndicator.innerHTML = '<i class="fas fa-moon"></i> Evening Session';
      }
    }
    
    updateGreeting();
  </script>
</body>
</html>