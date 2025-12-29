<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Neovox.AI - Assessment Summary</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com" onerror="console.error('Failed to load Tailwind CSS')"></script>
  <style>
    :root {
      --primary: #1B263B;
      --secondary: #415A77;
      --accent: #778DA9;
      --light: #E0E1DD;
      --white: #FFFFFF;
      --border: #E0E1DD;
      --glass-bg: rgba(255, 255, 255, 0.25);
      --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
    }

    .dark {
      --primary: #0A1C36;
      --secondary: #1E3A5F;
      --accent: #4A6FA5;
      --light: #A3BFFA;
      --white: #E6E9F0;
      --border: #3A4B6A;
      --glass-bg: rgba(10, 28, 54, 0.25);
      --glass-shadow: 0 8px 32px rgba(10, 28, 54, 0.3);
    }

    * {
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(145deg, #A8B5D2 0%, #D3DCE6 80%, #A8B5D2 100%);
      color: var(--primary);
      min-height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    .dark body {
      background: linear-gradient(145deg, #0A1C36 0%, #1E3A5F 80%, #0A1C36 100%);
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 1rem;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .header {
      position: sticky;
      top: 0;
      padding: 1rem;
      text-align: center;
      z-index: 10;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header a {
      font-size: clamp(1.5rem, 4vw, 1.75rem);
      font-weight: 700;
      color: var(--white);
      text-decoration: none;
    }

    .header a span {
      color: var(--accent);
    }

    .theme-toggle {
      background: var(--glass-bg);
      border-radius: 50%;
      width: clamp(2.25rem, 5vw, 2.5rem);
      height: clamp(2.25rem, 5vw, 2.5rem);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: var(--glass-shadow);
      transition: all 0.3s ease;
    }

    .theme-toggle:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .theme-toggle svg {
      width: clamp(1rem, 3vw, 1.25rem);
      height: clamp(1rem, 3vw, 1.25rem);
      fill: var(--accent);
    }

    .dark .theme-toggle svg {
      fill: var(--light);
    }

    .assessment-container {
      background: var(--glass-bg);
      backdrop-filter: blur(8px);
      border: 1px solid var(--border);
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: var(--glass-shadow);
      animation: fadeIn 0.5s ease-out;
      margin-bottom: 1rem;
    }

    .dark .assessment-container {
      background: var(--glass-bg);
      border: 1px solid var(--border);
    }

    .assessment-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .assessment-header h2 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--primary);
    }

    .dark .assessment-header h2 {
      color: var(--white);
    }

    .close-button {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--accent);
    }

    .dark .close-button {
      color: var(--light);
    }

    .assessment-summary {
      margin-bottom: 1.5rem;
    }

    .assessment-summary p {
      font-size: 0.9rem;
      line-height: 1.5;
      color: var(--primary);
    }

    .dark .assessment-summary p {
      color: var(--white);
    }

    .assessment-metrics {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .metric-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .metric-icon {
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      background: var(--secondary);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: 1rem;
    }

    .dark .metric-icon {
      background: var(--accent);
      color: var(--white);
    }

    .metric-info {
      flex: 1;
    }

    .metric-info p {
      font-size: 0.9rem;
      margin: 0;
      color: var(--primary);
    }

    .dark .metric-info p {
      color: var(--white);
    }

    .metric-level {
      color: var(--accent);
      font-weight: 500;
    }

    .dark .metric-level {
      color: var(--light);
    }

    .view-full {
      display: block;
      text-align: center;
      color: var(--accent);
      font-weight: 600;
      text-decoration: underline;
      margin-top: 1rem;
      cursor: pointer;
    }

    .dark .view-full {
      color: var(--light);
    }

    .feedback-container {
      background: var(--glass-bg);
      backdrop-filter: blur(8px);
      border: 1px solid var(--border);
      border-radius: 1rem;
      padding: 1rem;
      box-shadow: var(--glass-shadow);
      animation: fadeIn 0.5s ease-out;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .dark .feedback-container {
      background: var(--glass-bg);
      border: 1px solid var(--border);
    }

    .feedback-question {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .feedback-question img {
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
    }

    .feedback-question p {
      color: var(--primary);
    }

    .dark .feedback-question p {
      color: var(--white);
    }

    .feedback-buttons {
      display: flex;
      gap: 0.5rem;
      justify-content: center;
    }

    .feedback-button {
      background: linear-gradient(145deg, var(--white), var(--light));
      color: var(--primary);
      border-radius: 2rem;
      padding: 0.5rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .dark .feedback-button {
      background: linear-gradient(145deg, var(--light), var(--accent));
      color: var(--white);
    }

    .feedback-button:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(119, 141, 169, 0.3);
    }

    .dark .feedback-button:hover {
      box-shadow: 0 6px 16px rgba(74, 111, 165, 0.3);
    }

    .feedback-button svg {
      width: 1rem;
      height: 1rem;
      stroke: var(--primary);
    }

    .dark .feedback-button svg {
      stroke: var(--white);
    }

    .continue-button {
      background: var(--accent);
      color: var(--white);
      border-radius: 2rem;
      padding: 0.75rem;
      text-align: center;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 1rem;
    }

    .dark .continue-button {
      background: var(--light);
      color: var(--primary);
    }

    .continue-button:hover {
      background: var(--secondary);
      transform: scale(1.02);
    }

    .dark .continue-button:hover {
      background: var(--accent);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
      .container {
        padding: 0.5rem;
      }
      .header a {
        font-size: clamp(1.25rem, 3.5vw, 1.5rem);
      }
      .theme-toggle {
        width: clamp(2rem, 4.5vw, 2.25rem);
        height: clamp(2rem, 4.5vw, 2.25rem);
      }
      .theme-toggle svg {
        width: clamp(0.9rem, 2.5vw, 1.1rem);
        height: clamp(0.9rem, 2.5vw, 1.1rem);
      }
      .assessment-container, .feedback-container {
        padding: 1rem;
      }
      .assessment-header h2 {
        font-size: 1rem;
      }
      .close-button {
        font-size: 1.25rem;
      }
      .assessment-summary p, .metric-info p {
        font-size: 0.85rem;
      }
      .metric-icon, .feedback-question img {
        width: 1.5rem;
        height: 1.5rem;
      }
      .feedback-button {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
      }
      .feedback-button svg {
        width: 0.9rem;
        height: 0.9rem;
      }
      .continue-button {
        padding: 0.5rem;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <a href="../conversational-ai" aria-label="Neovox.AI Home">Neovox.<span>AI</span></a>
      <button class="theme-toggle" id="themeToggle" aria-label="Toggle Dark Mode">
        <svg viewBox="0 0 24 24" class="theme-icon sun">
          <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <svg viewBox="0 0 24 24" class="theme-icon moon" style="display: none;">
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
        </svg>
      </button>
    </div>

    <!-- Assessment Summary -->
    <div class="assessment-container">
      <div class="assessment-header">
        <h2>Assessment Summary</h2>
        <button class="close-button" onclick="window.location.href='../learning'">×</button>
      </div>
      <div class="assessment-summary">
        <p id="summaryText">No summary available. Please complete a session to see your assessment.</p>
      </div>
      <div class="assessment-metrics">
        <div class="metric-item">
          <div class="metric-icon">E</div>
          <div class="metric-info">
            <p>Vocabulary: <span class="metric-level" id="vocabLevel">N/A</span></p>
          </div>
        </div>
        <div class="metric-item">
          <div class="metric-icon">🎙️</div>
          <div class="metric-info">
            <p>Pronunciation: <span class="metric-level" id="pronunciationLevel">N/A</span></p>
          </div>
        </div>
        <div class="metric-item">
          <div class="metric-icon">📝</div>
          <div class="metric-info">
            <p>Grammar: <span class="metric-level" id="grammarLevel">N/A</span></p>
          </div>
        </div>
        <div class="metric-item">
          <div class="metric-icon">✅</div>
          <div class="metric-info">
            <p>Tasks completed: <span class="metric-level" id="tasksLevel">N/A</span></p>
          </div>
        </div>
      </div>
      <a class="view-full" onclick="showFullAssessment()">VIEW FULL ASSESSMENT</a>
    </div>

    <!-- Feedback Question -->
    <div class="feedback-container">
      <div class="feedback-question">
        <img src="https://via.placeholder.com/32" alt="AI Avatar">
        <p>Did you enjoy this conversation with me?</p>
      </div>
      <div class="feedback-buttons">
        <button class="feedback-button" onclick="submitFeedback('Yes')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0113.263 21H6a2 2 0 01-2-2V5a2 2 0 012-2h6a2 2 0 012 2v5zm-2 0V5H6v14h7.263l3.5-7H12v2"/>
          </svg>
          Yes, I did
        </button>
        <button class="feedback-button" onclick="submitFeedback('No')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 00-1.789 2.894l3.5 7A2 2 0 0010.737 25H18a2 2 0 002-2V9a2 2 0 00-2-2h-6a2 2 0 00-2 2v5zm2-4V9h6v14h-7.263l-3.5-7H12v2"/>
          </svg>
          Not really
        </button>
      </div>
    </div>

    <!-- Continue Button -->
    <div class="continue-button" onclick="window.location.href='../index.php'">CONTINUE</div>
  </div>

  <script>
    let assessmentData = JSON.parse(localStorage.getItem('assessmentData')) || {
      vocabulary: 'Intermediate',
      pronunciation: 'Intermediate',
      grammar: 'Intermediate',
      tasksCompleted: 'ALL',
      summary: 'Your language skills are improving, but you should work on enhancing clarity and engagement in your communication. Aim to provide more inviting and enthusiastic responses while ensuring your tone remains conversational to foster better connections.'
    };

    let progressData = JSON.parse(localStorage.getItem('progressData')) || {
      sessions: 0,
      scenarios: {},
      totalTime: 0,
      lastSession: null,
      assessments: []
    };

    // Theme toggle functionality
    const themeToggle = document.getElementById('themeToggle');
    const sunIcon = themeToggle.querySelector('.sun');
    const moonIcon = themeToggle.querySelector('.moon');

    function toggleTheme() {
      document.documentElement.classList.toggle('dark');
      const isDark = document.documentElement.classList.contains('dark');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
      sunIcon.style.display = isDark ? 'none' : 'block';
      moonIcon.style.display = isDark ? 'block' : 'none';
    }

    function initializeTheme() {
      const savedTheme = localStorage.getItem('theme');
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        document.documentElement.classList.add('dark');
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'block';
      } else {
        sunIcon.style.display = 'block';
        moonIcon.style.display = 'none';
      }
    }

    themeToggle.addEventListener('click', toggleTheme);

    document.addEventListener('DOMContentLoaded', () => {
      initializeTheme();
      console.log('Assessment Data:', assessmentData); // Debug
      console.log('Progress Data:', progressData); // Debug

      // Display assessment data with fallback
      document.getElementById('vocabLevel').textContent = assessmentData.vocabulary || 'N/A';
      document.getElementById('pronunciationLevel').textContent = assessmentData.pronunciation || 'N/A';
      document.getElementById('grammarLevel').textContent = assessmentData.grammar || 'N/A';
      document.getElementById('tasksLevel').textContent = assessmentData.tasksCompleted || 'N/A';
      document.getElementById('summaryText').textContent = assessmentData.summary || 'No summary available.';
    });

    function showFullAssessment() {
      alert('Full assessment feature is coming soon!');
    }

    function submitFeedback(response) {
      assessmentData.feedback = response;
      progressData.assessments.push(assessmentData);
      localStorage.setItem('assessmentData', JSON.stringify(assessmentData));
      localStorage.setItem('progressData', JSON.stringify(progressData));
      window.location.href = '../index.php';
    }
  </script>
</body>
</html>