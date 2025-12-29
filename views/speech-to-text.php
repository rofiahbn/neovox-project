<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Speech to Text - Dashboard</title>
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

    /* Speech to Text Specific Styles */
    .speech-container {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .recording-controls, .upload-controls {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .btn-recording {
      padding: 0.75rem 1.5rem;
      border-radius: 2rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: var(--transition);
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      touch-action: manipulation;
      min-height: 44px;
      min-width: 120px;
      justify-content: center;
      text-align: center;
    }

    .btn-start {
      background: linear-gradient(135deg, var(--success), #3ab0d8);
      color: white;
      border: none;
    }

    .btn-stop {
      background: linear-gradient(135deg, var(--danger), #e01b74);
      color: white;
      border: none;
    }

    .btn-download {
      background: linear-gradient(135deg, var(--primary), #2a4b7c);
      color: white;
      border: none;
    }

    .btn-transcribe {
      background: linear-gradient(135deg, var(--secondary), #2e2fa5);
      color: white;
      border: none;
    }

    .btn-recording:hover:not(:disabled) {
      transform: translateY(-2px);
      filter: brightness(1.1);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-recording:active:not(:disabled) {
      transform: translateY(0);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-recording:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    .upload-box {
      border: 2px dashed var(--gray-light);
      border-radius: 0.75rem;
      padding: 2rem;
      text-align: center;
      background: var(--light);
      width: 100%;
      max-width: 600px;
      margin: 0 auto 1.5rem;
      transition: var(--transition);
      cursor: pointer;
    }

    .upload-box.dragover {
      border-color: var(--primary);
      background: rgba(18, 52, 88, 0.05);
    }

    .upload-box i {
      font-size: 2rem;
      color: var(--primary);
      margin-bottom: 0.5rem;
    }

    .upload-box p {
      color: var(--gray);
      font-size: 1rem;
      margin: 0.5rem 0;
    }

    .upload-box .file-info {
      color: var(--dark);
      font-weight: 500;
      word-break: break-all;
    }

    .status-indicator {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.75rem;
      border-radius: 0.5rem;
      margin-bottom: 1.5rem;
    }

    .status-listening {
      background-color: rgba(76, 201, 240, 0.1);
      color: var(--success);
    }

    .status-idle {
      background-color: rgba(108, 117, 125, 0.1);
      color: var(--gray);
    }

    .transcript-container {
      border: 1px solid rgba(0, 0, 0, 0.1);
      border-radius: 0.75rem;
      padding: 1.5rem;
      min-height: 200px;
      background-color: #f9fafb;
    }

    .transcript-text {
      white-space: pre-wrap;
      line-height: 1.6;
    }

    .language-selector {
      margin-bottom: 1.5rem;
    }

    select {
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      border: 1px solid var(--gray-light);
      background-color: white;
      font-family: 'Poppins', sans-serif;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.5; }
      100% { opacity: 1; }
    }

    .pulse {
      animation: pulse 1.5s infinite;
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

    /* Responsive Design */
    @media (max-width: 768px) {
      .recording-controls {
        flex-wrap: wrap;
        gap: 0.75rem;
        justify-content: center;
      }
      .upload-controls {
        flex-wrap: wrap;
        gap: 0.75rem;
        justify-content: center;
      }
      .btn-recording {
        padding: 0.8rem 1.8rem;
        font-size: 0.9rem;
        min-width: 100px;
        flex: 1 1 auto;
      }
      .upload-box {
        padding: 1.5rem;
        max-width: 100%;
      }
      .main-content {
        padding: 1.5rem;
      }
      .content-header h1 {
        font-size: 1.5rem;
      }
      .content-header p {
        font-size: 0.9rem;
      }
    }

    @media (max-width: 480px) {
      .btn-recording {
        padding: 0.7rem 1.5rem;
        font-size: 0.85rem;
        min-width: 90px;
      }
      .recording-controls, .upload-controls {
        gap: 0.5rem;
      }
      .upload-box {
        padding: 1rem;
      }
      .upload-box i {
        font-size: 1.5rem;
      }
      .upload-box p {
        font-size: 0.9rem;
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
        <li><a href="/sound-effects"><i class="fas fa-headphones"></i> Sound Effects</a></li>
        <li><a href="/audio-tools"><i class="fas fa-tools"></i> Audio Tools</a></li>

        <li class="category">AI Features</li>
        <li><a href="/conversational-ai"><i class="fas fa-comments"></i> Conversational AI</a></li>
        <li><a href="/speech-to-text" class="active"><i class="fas fa-microphone-alt-slash"></i> Speech to Text</a></li>
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="main">
    <div class="content-header">
      <h1>Speech to Text</h1>
      <p>Convert your spoken words or audio files into written text with our AI-powered transcription</p>
    </div>
    <div class="content-body">
      <div class="speech-container">
        <div class="language-selector">
          <label for="language-select">Select Language: </label>
          <select id="language-select">
            <option value="en-US">English (US)</option>
            <option value="en-GB">English (UK)</option>
            <option value="es-ES">Spanish</option>
            <option value="fr-FR">French</option>
            <option value="de-DE">German</option>
            <option value="it-IT">Italian</option>
            <option value="pt-BR">Portuguese (Brazil)</option>
            <option value="ja-JP">Japanese</option>
            <option value="ko-KR">Korean</option>
            <option value="zh-CN">Chinese (Simplified)</option>
          </select>
        </div>

        <div class="status-indicator status-idle" id="statusIndicator">
          <i class="fas fa-microphone-slash"></i>
          <span>Ready to transcribe</span>
        </div>

        <div class="recording-controls">
          <button class="btn-recording btn-start" id="startRecording">
            <i class="fas fa-microphone"></i>
            Start Recording
          </button>
          <button class="btn-recording btn-stop" id="stopRecording" disabled>
            <i class="fas fa-stop"></i>
            Stop
          </button>
          <button class="btn-recording btn-download" id="downloadText" disabled>
            <i class="fas fa-download"></i>
            Download Text
          </button>
        </div>

        <div class="upload-box" id="uploadBox">
          <input type="file" id="audio-upload" accept="audio/mp3,audio/wav" style="display: none;">
          <i class="fas fa-upload"></i>
          <p>Drag & drop audio file here or click to select</p>
          <p class="file-info" id="fileInfo"></p>
        </div>
        <div class="upload-controls">
          <button class="btn-recording btn-transcribe" id="transcribeFile" disabled>
            <i class="fas fa-microphone-alt"></i> Transcribe File
          </button>
        </div>

        <div class="transcript-container">
          <div class="transcript-text" id="transcriptText">
            Your transcribed text will appear here...
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

    // Speech to Text Functionality
    const startBtn = document.getElementById('startRecording');
    const stopBtn = document.getElementById('stopRecording');
    const downloadBtn = document.getElementById('downloadText');
    const transcriptText = document.getElementById('transcriptText');
    const statusIndicator = document.getElementById('statusIndicator');
    const languageSelect = document.getElementById('language-select');
    const uploadBox = document.getElementById('uploadBox');
    const audioUpload = document.getElementById('audio-upload');
    const fileInfo = document.getElementById('fileInfo');
    const transcribeFileBtn = document.getElementById('transcribeFile');

    let recognition;
    let isRecording = false;
    let transcript = '';

    // Check if browser supports SpeechRecognition
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    if (SpeechRecognition) {
      recognition = new SpeechRecognition();
      recognition.continuous = true;
      recognition.interimResults = true;

      recognition.onstart = () => {
        isRecording = true;
        startBtn.disabled = true;
        stopBtn.disabled = false;
        downloadBtn.disabled = true;
        transcribeFileBtn.disabled = true;
        statusIndicator.className = 'status-indicator status-listening';
        statusIndicator.innerHTML = '<i class="fas fa-microphone pulse"></i><span>Listening...</span>';
      };

      recognition.onresult = (event) => {
        let interimTranscript = '';
        let finalTranscript = '';

        for (let i = event.resultIndex; i < event.results.length; i++) {
          const transcriptPiece = event.results[i][0].transcript;
          if (event.results[i].isFinal) {
            finalTranscript += transcriptPiece + ' ';
          } else {
            interimTranscript += transcriptPiece;
          }
        }

        transcript += finalTranscript;
        transcriptText.innerHTML = transcript + '<span style="color:#999">' + interimTranscript + '</span>';
      };

      recognition.onerror = (event) => {
        console.error('Recognition error:', event.error);
        stopRecording();
      };

      recognition.onend = () => {
        if (isRecording) {
          recognition.start(); // Restart recording if it ended unexpectedly
        }
      };

      function startRecording() {
        if (recognition) {
          transcript = ''; // Reset transcript
          transcriptText.textContent = 'Listening...';
          recognition.lang = languageSelect.value;
          recognition.start();
        }
      }

      function stopRecording() {
        if (recognition) {
          isRecording = false;
          recognition.stop();
          startBtn.disabled = false;
          stopBtn.disabled = true;
          downloadBtn.disabled = !transcript;
          transcribeFileBtn.disabled = !audioUpload.files.length;
          statusIndicator.className = 'status-indicator status-idle';
          statusIndicator.innerHTML = '<i class="fas fa-microphone-slash"></i><span>Recording stopped</span>';
          if (!transcript) {
            transcriptText.textContent = 'Your transcribed text will appear here...';
          }
        }
      }

      startBtn.addEventListener('click', startRecording);
      startBtn.addEventListener('touchstart', startRecording, { passive: true });
      stopBtn.addEventListener('click', stopRecording);
      stopBtn.addEventListener('touchstart', stopRecording, { passive: true });
      downloadBtn.addEventListener('click', () => {
        if (transcript) {
          const blob = new Blob([transcript], { type: 'text/plain' });
          const url = URL.createObjectURL(blob);
          const a = document.createElement('a');
          a.href = url;
          a.download = 'transcript.txt';
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);
          URL.revokeObjectURL(url);
        }
      });
      downloadBtn.addEventListener('touchstart', () => {
        if (transcript) {
          const blob = new Blob([transcript], { type: 'text/plain' });
          const url = URL.createObjectURL(blob);
          const a = document.createElement('a');
          a.href = url;
          a.download = 'transcript.txt';
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);
          URL.revokeObjectURL(url);
        }
      }, { passive: true });

      languageSelect.addEventListener('change', () => {
        if (recognition) {
          recognition.lang = languageSelect.value;
        }
      });
    } else {
      startBtn.disabled = true;
      statusIndicator.innerHTML = '<i class="fas fa-exclamation-triangle"></i><span>Speech recognition not supported in your browser</span>';
      console.warn('Speech recognition not supported');
    }

    // Drag-and-drop and file upload
    uploadBox.addEventListener('click', () => audioUpload.click());
    uploadBox.addEventListener('touchstart', () => audioUpload.click(), { passive: true });

    uploadBox.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadBox.classList.add('dragover');
    });

    uploadBox.addEventListener('dragleave', () => {
      uploadBox.classList.remove('dragover');
    });

    uploadBox.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadBox.classList.remove('dragover');
      const files = e.dataTransfer.files;
      if (files.length && files[0].type.startsWith('audio/')) {
        audioUpload.files = files;
        fileInfo.textContent = `Selected: ${files[0].name}`;
        transcribeFileBtn.disabled = false;
      } else {
        fileInfo.textContent = 'Please drop an audio file (.mp3 or .wav)';
      }
    });

    audioUpload.addEventListener('change', () => {
      if (audioUpload.files.length) {
        fileInfo.textContent = `Selected: ${audioUpload.files[0].name}`;
        transcribeFileBtn.disabled = false;
      } else {
        fileInfo.textContent = '';
        transcribeFileBtn.disabled = true;
      }
    });

    transcribeFileBtn.addEventListener('click', () => {
      const file = audioUpload.files[0];
      if (file) {
        statusIndicator.className = 'status-indicator status-listening';
        statusIndicator.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Processing file...</span>';
        startBtn.disabled = true;
        transcribeFileBtn.disabled = true;
        downloadBtn.disabled = true;

        // Simulasi transkripsi file (ganti dengan API nyata jika ada)
        setTimeout(() => {
          const simulatedTranscript = `Transcribed from ${file.name}: This is a sample transcription of the uploaded audio file.`;
          transcript = simulatedTranscript;
          transcriptText.textContent = transcript;
          statusIndicator.className = 'status-indicator status-idle';
          statusIndicator.innerHTML = '<i class="fas fa-microphone-slash"></i><span>File processed</span>';
          startBtn.disabled = false;
          transcribeFileBtn.disabled = false;
          downloadBtn.disabled = false;
        }, 2000);
      }
    });

    transcribeFileBtn.addEventListener('touchstart', () => {
      const file = audioUpload.files[0];
      if (file) {
        statusIndicator.className = 'status-indicator status-listening';
        statusIndicator.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Processing file...</span>';
        startBtn.disabled = true;
        transcribeFileBtn.disabled = true;
        downloadBtn.disabled = true;

        // Simulasi transkripsi file (ganti dengan API nyata jika ada)
        setTimeout(() => {
          const simulatedTranscript = `Transcribed from ${file.name}: This is a sample transcription of the uploaded audio file.`;
          transcript = simulatedTranscript;
          transcriptText.textContent = transcript;
          statusIndicator.className = 'status-indicator status-idle';
          statusIndicator.innerHTML = '<i class="fas fa-microphone-slash"></i><span>File processed</span>';
          startBtn.disabled = false;
          transcribeFileBtn.disabled = false;
          downloadBtn.disabled = false;
        }, 2000);
      }
    }, { passive: true });
  </script>
</body>
</html>