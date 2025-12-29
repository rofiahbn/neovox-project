<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Voice Library</title>
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
      --gray-light: #e2e8f0;
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
      display: flex;
      justify-content: space-between;
      align-items: center;
      animation: fadeIn 0.5s ease-out;
    }

    .content-header h1 {
      color: var(--dark);
      font-size: 2rem;
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

    /* Filter Section */
    .filter-section {
      margin-bottom: 1.5rem;
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .filter-section input {
      width: 100%;
      max-width: 300px;
      padding: 0.7rem;
      border: 1px solid var(--gray-light);
      border-radius: 0.3rem;
      font-size: 0.9rem;
      transition: var(--transition);
    }

    .filter-section input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(18, 52, 88, 0.1);
    }

    /* Dropdown Styles */
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

    /* Voice List Styles */
    .voice-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .voice-card {
      background-color: #fff;
      border-radius: 0.5rem;
      padding: 1rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      transition: var(--transition);
    }

    .voice-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .voice-card h3 {
      font-size: 1.1rem;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .voice-card p {
      font-size: 0.85rem;
      color: var(--gray);
      margin-bottom: 0.5rem;
    }

    .voice-card .category {
      font-size: 0.8rem;
      color: var(--primary);
      background-color: rgba(18, 52, 88, 0.1);
      padding: 0.2rem 0.5rem;
      border-radius: 0.2rem;
      display: inline-block;
      margin-bottom: 1rem;
    }

    .voice-card .btn-group {
      display: flex;
      gap: 0.5rem;
    }

    .btn {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 0.3rem;
      font-size: 0.85rem;
      cursor: pointer;
      transition: var(--transition);
      font-weight: 500;
    }

    .btn-primary {
      background-color: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background-color: var(--primary-dark);
    }

    .btn-secondary {
      background-color: var(--gray);
      color: white;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }

    /* Upload Section Styles */
    .upload-section {
      margin-top: 2rem;
      padding: 1.5rem;
      border: 2px dashed var(--gray-light);
      border-radius: 0.5rem;
      text-align: center;
      transition: var(--transition);
    }

    .upload-section.dragover {
      border: 2px dashed var(--primary);
      background-color: rgba(18, 52, 88, 0.05);
    }

    .upload-section h2 {
      font-size: 1.3rem;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .upload-section p {
      color: var(--gray);
      font-size: 0.9rem;
      margin-bottom: 1rem;
    }

    .upload-section input[type="file"] {
      display: none;
    }

    .upload-section label {
      display: inline-block;
      padding: 0.7rem 1.5rem;
      background-color: var(--primary);
      color: white;
      border-radius: 0.3rem;
      cursor: pointer;
      transition: var(--transition);
    }

    .upload-section label:hover {
      background-color: var(--primary-dark);
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

    /* Responsive Design */
    @media (max-width: 768px) {
      .voice-list {
        grid-template-columns: 1fr;
      }
      .filter-section {
        flex-direction: column;
      }
      .filter-section input,
      .dropdown {
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
        <li><a href="/voice-library" class="active"><i class="fas fa-volume-up"></i> Voice Library</a></li>
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
      <div>
        <h1>Voice Library</h1>
        <p>Explore and manage your voice assets.</p>
      </div>
    </div>
    <div class="content-body">
      <!-- Filter Section -->
      <div class="filter-section">
        <input type="text" id="voiceFilter" placeholder="Search voices...">
        <div class="dropdown">
          <button class="dropdown-toggle" id="categoryFilter">All Categories</button>
          <ul class="dropdown-menu" id="categoryMenu">
            <li data-value="all">All Categories</li>
            <li data-value="male">Male</li>
            <li data-value="female">Female</li>
            <li data-value="neutral">Neutral</li>
            <li data-value="energetic">Energetic</li>
            <li data-value="calm">Calm</li>
          </ul>
        </div>
      </div>

      <!-- Voice List -->
      <div class="voice-list">
        <div class="voice-card" data-category="male">
          <h3>Voice 1</h3>
          <span class="category">Male</span>
          <p>Deep male voice, suitable for narration.</p>
          <div class="btn-group">
            <button class="btn btn-primary" onclick="previewVoice('Voice 1')">Preview</button>
            <button class="btn btn-secondary">Use</button>
          </div>
        </div>
        <div class="voice-card" data-category="female">
          <h3>Voice 2</h3>
          <span class="category">Female</span>
          <p>Soft female voice, ideal for audiobooks.</p>
          <div class="btn-group">
            <button class="btn btn-primary" onclick="previewVoice('Voice 2')">Preview</button>
            <button class="btn btn-secondary">Use</button>
          </div>
        </div>
        <div class="voice-card" data-category="neutral">
          <h3>Voice 3</h3>
          <span class="category">Neutral</span>
          <p>Neutral voice, great for commercials.</p>
          <div class="btn-group">
            <button class="btn btn-primary" onclick="previewVoice('Voice 3')">Preview</button>
            <button class="btn btn-secondary">Use</button>
          </div>
        </div>
        <div class="voice-card" data-category="energetic">
          <h3>Voice 4</h3>
          <span class="category">Energetic</span>
          <p>Energetic voice, perfect for ads.</p>
          <div class="btn-group">
            <button class="btn btn-primary" onclick="previewVoice('Voice 4')">Preview</button>
            <button class="btn btn-secondary">Use</button>
          </div>
        </div>
        <div class="voice-card" data-category="calm">
          <h3>Voice 5</h3>
          <span class="category">Calm</span>
          <p>Calm voice, suitable for meditation.</p>
          <div class="btn-group">
            <button class="btn btn-primary" onclick="previewVoice('Voice 5')">Preview</button>
            <button class="btn btn-secondary">Use</button>
          </div>
        </div>
      </div>

      <!-- Upload Section -->
      <div class="upload-section" id="uploadSection">
        <h2>Upload New Voice</h2>
        <p>Drag and drop your audio files here or click to browse.</p>
        <input type="file" id="voiceUpload" accept="audio/*" multiple>
        <label for="voiceUpload">Select Files</label>
      </div>
    </div>
  </div>

  <!-- Notification -->
  <div class="notification" id="notification">
    File uploaded successfully!
  </div>

  <script>
    // Smooth hover effect with delay (Original)
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

    // Voice Preview (Placeholder)
    function previewVoice(voiceName) {
      alert(`Previewing ${voiceName}`);
      // Implement actual audio playback here
    }

    // Voice Filter (Search and Category)
    const voiceFilter = document.querySelector('#voiceFilter');
    const categoryFilter = document.querySelector('#categoryFilter');
    const categoryMenu = document.querySelector('#categoryMenu');
    const voiceCards = document.querySelectorAll('.voice-card');
    let currentCategory = 'all';

    function filterVoices() {
      const searchValue = voiceFilter.value.toLowerCase();
      const categoryValue = currentCategory;

      voiceCards.forEach(card => {
        const voiceName = card.querySelector('h3').textContent.toLowerCase();
        const voiceCategory = card.dataset.category;

        const matchesSearch = voiceName.includes(searchValue);
        const matchesCategory = categoryValue === 'all' || voiceCategory === categoryValue;

        card.style.display = matchesSearch && matchesCategory ? 'block' : 'none';
      });
    }

    voiceFilter.addEventListener('input', filterVoices);

    // Dropdown Handling
    categoryFilter.addEventListener('click', () => {
      categoryMenu.classList.toggle('show');
    });

    categoryMenu.querySelectorAll('li').forEach(item => {
      item.addEventListener('click', () => {
        currentCategory = item.dataset.value;
        categoryFilter.textContent = item.textContent;
        categoryMenu.classList.remove('show');
        filterVoices();
      });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (!categoryFilter.contains(e.target) && !categoryMenu.contains(e.target)) {
        categoryMenu.classList.remove('show');
      }
    });

    // File Upload with Drag and Drop
    const uploadSection = document.querySelector('#uploadSection');
    const voiceUpload = document.querySelector('#voiceUpload');
    const notification = document.querySelector('#notification');

    uploadSection.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadSection.classList.add('dragover');
    });

    uploadSection.addEventListener('dragleave', () => {
      uploadSection.classList.remove('dragover');
    });

    uploadSection.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadSection.classList.remove('dragover');
      const files = e.dataTransfer.files;
      handleFiles(files);
    });

    voiceUpload.addEventListener('change', () => {
      handleFiles(voiceUpload.files);
    });

    function handleFiles(files) {
      for (const file of files) {
        if (file.type.startsWith('audio/')) {
          notification.textContent = `Uploaded ${file.name} successfully!`;
          notification.classList.add('show');
          setTimeout(() => {
            notification.classList.remove('show');
          }, 3000);
        } else {
          notification.textContent = 'Please upload audio files only.';
          notification.style.backgroundColor = 'var(--danger)';
          notification.classList.add('show');
          setTimeout(() => {
            notification.classList.remove('show');
            notification.style.backgroundColor = 'var(--success)';
          }, 3000);
        }
      }
    }
  </script>
</body>
</html>