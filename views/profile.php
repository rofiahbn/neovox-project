<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile</title>
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
      --gray-light: #e2e8f0; /* Added to match previous pages */
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

    /* Profile Specific Styles */
    .profile-section {
      margin-bottom: 2rem;
    }

    .profile-section h2 {
      font-size: 1.3rem;
      color: var(--dark);
      margin-bottom: 1rem;
      font-weight: 600;
    }

    .profile-field {
      margin-bottom: 1rem;
    }

    .profile-field label {
      display: block;
      font-size: 0.9rem;
      color: var(--gray);
      margin-bottom: 0.3rem;
    }

    .profile-field input {
      width: 100%;
      padding: 0.7rem;
      border: 1px solid var(--gray-light);
      border-radius: 0.3rem;
      font-size: 0.9rem;
      transition: var(--transition);
    }

    .profile-field input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(18, 52, 88, 0.1);
    }

    .btn {
      padding: 0.7rem 1.5rem;
      border: none;
      border-radius: 0.3rem;
      font-size: 0.9rem;
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

    .btn-danger {
      background-color: var(--danger);
      color: white;
    }

    .btn-danger:hover {
      background-color: #c91c6b;
    }

    .btn-secondary {
      background-color: var(--gray);
      color: white;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }

    .toggle-switch {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: var(--transition);
      border-radius: 24px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: var(--transition);
      border-radius: 50%;
    }

    input:checked + .slider {
      background-color: var(--primary);
    }

    input:checked + .slider:before {
      transform: translateX(26px);
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
        <li><a href="/profile" class="active"><i class="fas fa-user"></i> Profile</a></li>

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
      <h1>Profile Settings</h1>
      <p>Manage your account details and security settings.</p>
    </div>
    <div class="content-body">
      <!-- Account Information -->
      <div class="profile-section">
        <h2>Account Information</h2>
        <div class="profile-field">
          <label for="name">Name</label>
          <input type="text" id="name" value="John Doe">
        </div>
        <div class="profile-field">
          <label for="email">Email</label>
          <input type="email" id="email" value="john.doe@example.com">
        </div>
        <button class="btn btn-primary">Update Email</button>
      </div>

      <!-- Change Password -->
      <div class="profile-section">
        <h2>Change Password</h2>
        <div class="profile-field">
          <label for="current-password">Current Password</label>
          <input type="password" id="current-password">
        </div>
        <div class="profile-field">
          <label for="new-password">New Password</label>
          <input type="password" id="new-password">
        </div>
        <div class="profile-field">
          <label for="confirm-password">Confirm New Password</label>
          <input type="password" id="confirm-password">
        </div>
        <button class="btn btn-primary">Update Password</button>
      </div>

      <!-- Current Plan -->
      <div class="profile-section">
        <h2>Current Plan</h2>
        <div class="profile-field">
          <label>Plan</label>
          <p style="font-size: 0.9rem; color: #334155;">Premium Plan - $19.99/month</p>
        </div>
        <button class="btn btn-secondary">Manage Subscription</button>
      </div>

      <!-- Two-Factor Authentication -->
      <div class="profile-section">
        <h2>Two-Factor Authentication</h2>
        <div class="toggle-switch">
          <label>Enable 2FA</label>
          <label class="switch">
            <input type="checkbox">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Delete Account -->
      <div class="profile-section">
        <h2>Delete Account</h2>
        <p style="color: var(--gray); margin-bottom: 1rem;">
          Permanently delete your account and all associated data. This action cannot be undone.
        </p>
        <button class="btn btn-danger">Delete Account</button>
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