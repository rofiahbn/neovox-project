<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Neovox.AI - Scenario Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background: url('img/onBoarding.jpg') center/cover no-repeat;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #FFFFFF;
      padding: clamp(10px, 2vw, 20px);
      overflow-x: hidden;
      position: relative;
    }

    .container {
      max-width: 2000px;
      margin: 0 auto;
      padding: 1rem clamp(0.5rem, 1vw, 1rem);
      flex: 1;
      display: flex;
      flex-direction: column;
      position: relative;
      width: 100%;
      padding-bottom: 3rem; /* Prevent overlap with bottom bar */
    }

    .header {
      position: relative;
      top: 0;
      padding: 1rem;
      text-align: center;
      z-index: 10;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: -1rem -1rem 0 -1rem;
    }

    .back-icon {
      background: rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(21.8px);
      border-radius: 50%;
      width: clamp(2rem, 5vw, 2.5rem);
      height: clamp(2rem, 5vw, 2.5rem);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      flex-shrink: 0;
    }

    .back-icon:hover,
    .back-icon:active {
      transform: scale(1.05);
      background: #374151;
    }

    .back-icon svg {
      width: clamp(0.9rem, 3vw, 1.25rem);
      height: clamp(0.9rem, 3vw, 1.25rem);
    }

    .header h1 {
      font-size: clamp(1.2rem, 4vw, 1.5rem);
      font-weight: 600;
      margin: 0 auto;
    }

    .search-bar {
      margin: 1rem 0;
      position: relative;
      width: 100%;
      max-width: 600px;
      align-self: center;
    }

    .search-bar input {
      width: 100%;
      padding: 0.75rem 1rem 0.75rem 2.5rem;
      border-radius: 1rem;
      border: none;
      background: rgba(255, 255, 255, 0.1);
      color: #FFFFFF;
      font-size: clamp(0.75rem, 2.5vw, 0.9rem);
      font-weight: 500;
      backdrop-filter: blur(21.8px);
    }

    .search-bar input::placeholder {
      color: #d1d5db;
    }

    .search-bar svg {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      width: clamp(0.9rem, 3vw, 1.25rem);
      height: clamp(0.9rem, 3vw, 1.25rem);
    }

    .scenarios-container {
      width: 100%;
      overflow-x: auto;
      padding-bottom: 1rem;
      -webkit-overflow-scrolling: touch;
    }

    .scenario-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: clamp(1rem, 2vw, 1.5rem);
      padding: 1rem 0;
      width: 100%;
    }

    .scenario-card {
        display: block; /* Membuat <a> berperilaku seperti block */
        text-decoration: none; /* Menghilangkan garis bawah */
        color: inherit; /* Warna teks sama dengan parent */
      min-width: 0;
      position: relative;
      border-radius: 1.25rem;
      overflow: hidden;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      aspect-ratio: 4 / 3;
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .scenario-card:hover,
    .scenario-card:active {
      transform: scale(1.03);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
    }

    .scenario-card .image-wrapper {
      position: relative;
      width: 100%;
      height: 100%;
    }

    .scenario-card .image-wrapper::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.6));
    }

    .scenario-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      top: 0;
      left: 0;
    }

    .scenario-card .title {
      position: absolute;
      bottom: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(12px);
      padding: clamp(0.4rem, 1vw, 0.6rem) clamp(0.6rem, 1.5vw, 0.8rem);
      text-align: left;
      font-size: clamp(0.55rem, 2vw, 0.75rem);
      font-weight: 500;
      line-height: 1.3;
      min-height: clamp(2rem, 6vw, 2.5rem);
      white-space: normal; /* Allow text wrap */
    }

    .subtitle {
      position: fixed;
      bottom: 4rem; /* Above bottom bar */
      left: 50%;
      transform: translateX(-50%);
      background: rgba(0, 0, 0, 0.7);
      color: #FFFFFF;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      font-size: clamp(0.8rem, 2.5vw, 1rem);
      max-width: 90%;
      text-align: center;
      display: none; /* Initially hidden */
      z-index: 5;
    }

    .bottom-bar {
      position: fixed;
      bottom: 0.5rem;
      left: 0;
      right: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      max-width: 100%;
      margin: 0 auto;
      z-index: 3;
      padding: 0 1rem;
    }

    .bottom-bar svg {
      width: clamp(150px, 80vw, 191px);
      height: auto;
      max-width: 100%;
    }

    /* Custom scrollbar for scenarios */
    .scenarios-container::-webkit-scrollbar {
      height: 6px;
    }
    
    .scenarios-container::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
    }
    
    .scenarios-container::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 10px;
    }
    
    .scenarios-container::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.5);
    }

    @media (max-width: 1200px) {
      .scenario-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      }
    }

    @media (max-width: 768px) {
      .container { 
        padding: 0.75rem clamp(0.25rem, 1vw, 0.5rem); 
      }
      .header {
        padding: 0.75rem;
      }
      .back-icon { 
        width: clamp(1.8rem, 4.5vw, 2rem); 
        height: clamp(1.8rem, 4.5vw, 2rem); 
      }
      .back-icon svg { 
        width: clamp(0.8rem, 2.5vw, 1rem); 
        height: clamp(0.8rem, 2.5vw, 1rem); 
      }
      .header h1 { 
        font-size: clamp(1rem, 3.5vw, 1.2rem); 
      }
      .search-bar { 
        margin: 0.75rem 0; 
      }
      .search-bar input { 
        padding: 0.6rem 0.8rem 0.6rem 2rem; 
        font-size: clamp(0.7rem, 2vw, 0.8rem); 
      }
      .search-bar svg { 
        left: 0.6rem; 
        width: clamp(0.8rem, 2.5vw, 1rem); 
        height: clamp(0.8rem, 2.5vw, 1rem); 
      }
      .scenario-grid { 
        gap: clamp(0.75rem, 2vw, 1rem); 
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      }
      .scenario-card { 
        border-radius: 1rem; 
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15); 
      }
      .scenario-card .title { 
        padding: clamp(0.3rem, 0.8vw, 0.5rem) clamp(0.5rem, 1.2vw, 0.7rem); 
        font-size: clamp(0.6rem, 1.8vw, 0.7rem); 
        min-height: clamp(1.8rem, 5vw, 2.2rem); 
      }
    }

    @media (max-width: 480px) {
      .container { 
        padding: 0.5rem clamp(0.25rem, 0.5vw, 0.5rem); 
      }
      .header {
        padding: 0.5rem;
      }
      .back-icon { 
        width: clamp(1.6rem, 4vw, 1.8rem); 
        height: clamp(1.6rem, 4vw, 1.8rem); 
      }
      .back-icon svg { 
        width: clamp(0.7rem, 2vw, 0.9rem); 
        height: clamp(0.7rem, 2vw, 0.9rem); 
      }
      .header h1 { 
        font-size: clamp(0.9rem, 3vw, 1rem); 
      }
      .search-bar input { 
        padding: 0.6rem 0.8rem 0.6rem 2rem; 
        font-size: clamp(0.7rem, 2vw, 0.8rem); 
      }
      .search-bar svg { 
        left: 0.5rem; 
        width: clamp(0.7rem, 2vw, 0.9rem); 
        height: clamp(0.7rem, 2vw, 0.9rem); 
      }
      .scenario-grid { 
        gap: clamp(0.5rem, 1.5vw, 0.75rem); 
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      }
      .scenario-card { 
        border-radius: 0.75rem; 
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15); 
      }
      .scenario-card .title { 
        padding: clamp(0.2rem, 0.6vw, 0.4rem) clamp(0.4rem, 1vw, 0.6rem); 
        font-size: clamp(0.6rem, 1.6vw, 0.7rem); 
        min-height: clamp(1.6rem, 4.5vw, 2rem); 
      }
    }

    @media (max-width: 360px) {
      .scenario-grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
      }
    }

    @media (max-width: 320px) {
      .scenario-grid {
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="back-icon" aria-label="Back to previous page">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <title>Back</title>
          <path d="M15 18L9 12L15 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <h1>Courses</h1>
      <div style="width: 2.5rem;"></div>
    </div>
    <div class="search-bar">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <title>Search</title>
        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M21 21L16.65 16.65" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <input type="text" placeholder="Search courses" aria-label="Search courses">
    </div>
    <div class="scenarios-container">
      <div class="scenario-grid">
        <div class="scenario-card">
            <a href="/ai" class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/introducing.jpg" alt="Introducing Yourself" loading="lazy">
          </div>
          <div class="title">Introducing Yourself</div>
            </a>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/order_restaurant.jpg" alt="Ordering Food At the Restaurant" loading="lazy">
          </div>
          <div class="title">Ordering Food At the Restaurant</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/grocery.jpg" alt="At the Grocery Store" loading="lazy">
          </div>
          <div class="title">At the Grocery Store</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/direction.jpeg" alt="Asking for Directions" loading="lazy">
          </div>
          <div class="title">Asking for Directions</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/daily.jpg" alt="Daily Routine" loading="lazy">
          </div>
          <div class="title">Daily Routine</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/smallTalk.jpg" alt="Making Small Talk" loading="lazy">
          </div>
          <div class="title">Making Small Talk</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/doctor.jpg" alt="At the Doctor's Office" loading="lazy">
          </div>
          <div class="title">At the Doctor's Office</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/clothes.jpg" alt="Going Shopping for Clothes" loading="lazy">
          </div>
          <div class="title">Going Shopping for Clothes</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/phone.jpg" alt="Phone Conversation with a Friend" loading="lazy">
          </div>
          <div class="title">Phone Conversation with a Friend</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/hobbies.png" alt="Talking About Hobbies" loading="lazy">
          </div>
          <div class="title">Talking About Hobbies</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/interview.jpg" alt="Job Interview" loading="lazy">
          </div>
          <div class="title">Job Interview</div>
        </div>
        <div class="scenario-card">
          <div class="image-wrapper">
            <img src="/img/airport.jpg" alt="Travelling at the Airport" loading="lazy">
          </div>
          <div class="title">Travelling at the Airport</div>
        </div>
      </div>
    </div>
    <div class="subtitle" id="subtitle"></div>
    <div class="bottom-bar">
      <svg width="191" height="43" viewBox="0 0 191 43" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="1.13013" y="0.25" width="189.5" height="42.5" rx="20.25" fill="black" fill-opacity="0.2" stroke="#FFA9F9" stroke-width="0.5"/>
        <rect x="1.38013" y="0.5" width="94.7185" height="42" rx="20" fill="url(#paint0_linear_16_272)"/>
        <g id="micArea" role="button" aria-label="Activate microphone" style="cursor: pointer; pointer-events: all;">
          <path id="micIcon" d="M40.7585 30.4331V18.5223L48.7394 12.567L56.7202 18.5223V30.4331H50.7346V23.4851H46.7442V30.4331H40.7585Z" fill="white"/>
        </g>
        <g id="playArea" role="button" aria-label="Start interaction" style="cursor: pointer; pointer-events: all;">
          <path id="playIcon" d="M147.508 13.4112H133.958C133.599 13.4112 133.254 13.5532 133 13.8061C132.746 14.0589 132.603 14.4018 132.603 14.7593V28.2407C132.603 28.5982 132.746 28.9411 133 29.1939C133.254 29.4468 133.599 29.5888 133.958 29.5888H143.163C143.341 29.5891 143.517 29.5543 143.681 29.4865C143.846 29.4187 143.995 29.3191 144.121 29.1936L148.466 24.8703C148.592 24.7454 148.692 24.5969 148.76 24.4334C148.828 24.2698 148.863 24.0944 148.863 23.9174V14.7593C148.863 14.4018 148.72 14.0589 148.466 13.8061C148.212 13.5532 147.867 13.4112 147.508 13.4112ZM138.023 18.1297H143.443C143.623 18.1297 143.795 18.2007 143.922 18.3271C144.049 18.4535 144.121 18.625 144.121 18.8037C144.121 18.9825 144.049 19.154 143.922 19.2804C143.795 19.4068 143.623 19.4778 143.443 19.4778H138.023C137.844 19.4778 137.671 19.4068 137.544 19.2804C137.417 19.154 137.346 18.9825 137.346 18.8037C137.346 18.625 137.417 18.4535 137.544 18.3271C137.671 18.2007 137.844 18.1297 138.023 18.1297ZM140.733 24.8703H138.023C137.844 24.8703 137.671 24.7993 137.544 24.6729C137.417 24.5465 137.346 24.375 137.346 24.1963C137.346 24.0175 137.417 23.846 137.544 23.7196C137.671 23.5932 137.844 23.5222 138.023 23.5222H140.733C140.913 23.5222 141.085 23.5932 141.212 23.7196C141.339 23.846 141.411 24.0175 141.411 24.1963C141.411 24.375 141.339 24.5465 141.212 24.6729C141.085 24.7993 140.913 24.8703 140.733 24.8703ZM138.023 22.1741C137.844 22.1741 137.671 22.103 137.544 21.9766C137.417 21.8502 137.346 21.6788 137.346 21.5C137.346 21.3212 137.417 21.1498 137.544 21.0234C137.671 20.897 137.844 20.8259 138.023 20.8259H143.443C143.623 20.8259 143.795 20.897 143.922 21.0234C144.049 21.1498 144.121 21.3212 144.121 21.5C144.121 21.6788 144.049 21.8502 143.922 21.9766C143.795 22.103 143.623 22.1741 143.443 22.1741H138.023ZM143.443 27.9618V24.1963H147.229L143.443 27.9618Z" fill="white"/>
        </g>
        <defs>
          <linearGradient id="paint0_linear_16_272" x1="1.38013" y1="42.5" x2="79.1107" y2="42.5" gradientUnits="userSpaceOnUse">
            <stop stop-color="#AE0ADF"/>
            <stop offset="1" stop-color="#7031F9"/>
          </linearGradient>
        </defs>
      </svg>
    </div>
  </div>

  <script>
    // Back button functionality
    const backIcon = document.querySelector('.back-icon');
    backIcon.addEventListener('click', () => {
      window.location.assign('/learning');
    });

  </script>
</body>
</html>