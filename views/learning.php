<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Neovox.AI - English Practice</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
      font-family: 'Montserrat', sans-serif;
    }

    body {
      background: url('img/onBoarding.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #FFFFFF;
      padding: clamp(10px, 2vw, 20px);
      overflow-x: hidden;
      position: relative;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 1rem;
      flex: 1;
      display: flex;
      flex-direction: column;
      position: relative;
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

    .menu-icon, .theme-toggle {
      background: rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(21.8px);
      border-radius: 50%;
      width: clamp(2.25rem, 5vw, 2.5rem);
      height: clamp(2.25rem, 5vw, 2.5rem);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .menu-icon:hover, .theme-toggle:hover {
      transform: scale(1.05);
      background: #374151;
    }

    .menu-icon svg, .theme-toggle svg {
      width: clamp(0.9rem, 3vw, 1.25rem);
      height: clamp(1rem, 3vw, 1.5rem);
    }

    .purple-layer {
      position: absolute;
      width: clamp(140px, 60vw, 223.67px);
      height: clamp(140px, 60vw, 223.67px);
      left: 50%;
      top: clamp(0px, 5vh, 50px);
      transform: translateX(-50%);
      background: #8623F0;
      border: 1px solid #FFFFFF;
      filter: blur(clamp(25px, 10vw, 40px));
      border-radius: 50%;
      z-index: 1;
    }

    .custom-mascot {
      position: absolute;
      width: clamp(140px, 60vw, 223.58px);
      height: clamp(125px, 53vw, 199px);
      top: clamp(50px, 10vh, 80px);
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
    }

    .chat-container {
      flex: 1;
      overflow-y: auto;
      padding: 1rem 0;
      max-height: 60vh;
      scroll-behavior: smooth;
      position: relative;
      z-index: 3;
      margin-top: clamp(200px, 40vh, 250px);
    }

    .message-bubble {
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      max-width: 80%;
      margin: 0.75rem;
      padding: 1rem;
      border-radius: 1rem;
      animation: fadeIn 0.5s ease-out;
      color: #FFFFFF;
      line-height: 1.5;
    }

    .message-bubble.ai {
      background: #D87CFF;
      border-radius: 1rem 1rem 1rem 0;
      margin-right: auto;
    }

    .message-bubble.user {
      background: #FFFFFF;
      border-radius: 1rem 1rem 0 1rem;
      margin-left: auto;
      color: #000000;
    }

    .bottom-bar {
      position: sticky;
      bottom: 1rem;
      display: flex;
      justify-content: center;
      align-items: center;
      max-width: 90%;
      margin: 0 auto;
      z-index: 3;
    }

    .bottom-bar svg {
      width: clamp(150px, 80vw, 191px);
      height: auto;
    }

    #homeArea:hover #homeIcon,
    #journeyArea:hover #journeyIcon {
      fill: #FFA9F9;
    }

    .popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.8);
      width: clamp(280px, 80vw, 320px);
      background: rgba(0, 0, 0, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 1.5rem;
      padding: 1rem;
      display: none;
      flex-direction: column;
      gap: 1rem;
      z-index: 100;
      opacity: 0;
      transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .popup.active {
      display: flex;
      transform: translate(-50%, -50%) scale(1);
      opacity: 1;
    }

    .popup-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem 1rem;
      border-radius: 1rem;
      color: white;
      font-size: clamp(1rem, 3vw, 1.2rem);
    }

    .popup-header h2 {
      text-align: center;
      width: 100%;
      position: relative;
      font-weight: 400; /* Not bold */
    }

    .close-btn {
      font-size: 1.5rem;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .close-btn:hover {
      color: #FFA9F9;
    }

    .menu-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .menu-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      background: white;
      color: black;
      border-radius: 1rem;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    .menu-item:hover {
      background: #FFA9F9;
      transform: scale(1.02);
    }

    .menu-item svg {
      width: 1.5rem;
      height: 1.5rem;
    }

    .menu-item span {
      font-size: clamp(0.9rem, 2.5vw, 1rem);
      font-weight: 500;
    }

    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
      z-index: 99;
    }

    .overlay.active {
      display: block;
    }

    body.popup-open {
      overflow: hidden;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      .container { padding: 0.75rem; }
      .menu-icon, .theme-toggle { width: clamp(2rem, 4.5vw, 2.25rem); height: clamp(2rem, 4.5vw, 2.25rem); }
      .menu-icon svg, .theme-toggle svg { width: clamp(0.9rem, 2.5vw, 1.1rem); height: clamp(0.9rem, 2.5vw, 1.1rem); }
      .purple-layer {
        width: clamp(140px, 60vw, 223.67px);
        height: clamp(140px, 60vw, 223.67px);
        top: clamp(0px, 5vh, 50px);
        filter: blur(clamp(25px, 10vw, 40px));
      }
      .custom-mascot {
        width: clamp(140px, 60vw, 223.58px);
        height: clamp(125px, 53vw, 199px);
        top: clamp(50px, 10vh, 80px);
      }
      .message-bubble { max-width: 85%; padding: 0.75rem; font-size: clamp(0.8rem, 2.5vw, 0.9rem); }
      .popup {
        width: clamp(260px, 80vw, 300px);
        padding: 0.75rem;
      }
      .popup-header {
        padding: 0.5rem 0.75rem;
        font-size: clamp(0.9rem, 2.5vw, 1.1rem);
      }
      .close-btn {
        font-size: 1.3rem;
      }
      .menu-item {
        padding: 0.6rem 0.8rem;
      }
      .menu-item svg {
        width: 1.3rem;
        height: 1.3rem;
      }
      .menu-item span {
        font-size: clamp(0.8rem, 2vw, 0.9rem);
      }
    }

    @media (max-width: 480px) {
      .message-bubble { max-width: 90%; font-size: clamp(0.75rem, 2.5vw, 0.85rem); }
      .menu-icon, .theme-toggle { width: clamp(1.8rem, 4vw, 2rem); height: clamp(1.8rem, 4vw, 2rem); }
      .menu-icon svg, .theme-toggle svg { width: clamp(0.8rem, 2.5vw, 1rem); height: clamp(0.8rem, 2.5vw, 1rem); }
      .purple-layer {
        width: clamp(140px, 60vw, 223.67px);
        height: clamp(140px, 60vw, 223.67px);
        top: clamp(0px, 5vh, 50px);
      }
      .custom-mascot {
        width: clamp(140px, 60vw, 223.58px);
        height: clamp(125px, 53vw, 199px);
        top: clamp(50px, 10vh, 80px);
      }
      .popup {
        width: clamp(240px, 80vw, 280px);
        padding: 0.5rem;
      }
      .popup-header {
        padding: 0.4rem 0.6rem;
        font-size: clamp(0.8rem, 2vw, 0.9rem);
      }
      .close-btn {
        font-size: 1.2rem;
      }
      .menu-item {
        padding: 0.5rem 0.6rem;
      }
      .menu-item svg {
        width: 1.2rem;
        height: 1.2rem;
      }
      .menu-item span {
        font-size: clamp(0.7rem, 1.8vw, 0.8rem);
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="menu-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 6H21V8H3V6ZM3 11H21V13H3V11ZM3 16H21V18H3V16Z" fill="white"/>
        </svg>
      </div>
      <div class="theme-toggle">
        <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.48804 20.0125C1.93804 20.0125 1.46737 19.8168 1.07604 19.4255C0.684704 19.0342 0.488704 18.5632 0.488037 18.0125V2.0125C0.488037 1.4625 0.684037 0.991828 1.07604 0.600495C1.46804 0.209162 1.9387 0.0131617 2.48804 0.012495H14.488C15.038 0.012495 15.509 0.208495 15.901 0.600495C16.293 0.992495 16.4887 1.46316 16.488 2.0125V18.0125C16.488 18.5625 16.2924 19.0335 15.901 19.4255C15.5097 19.8175 15.0387 20.0132 14.488 20.0125H2.48804ZM7.48804 9.0125L9.98804 7.5125L12.488 9.0125V2.0125H7.48804V9.0125Z" fill="white"/>
        </svg>
      </div>
    </div>
    <div class="popup">
      <div class="popup-header">
        <h2>All menu</h2>
        <span class="close-btn">Ã—</span>
      </div>
      <ul class="menu-list">
        <li class="menu-item">
          <svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0.112488 27.1251V9.47776L11.8774 0.654114L23.6422 9.47776V27.1251H14.8186V16.8308H8.93614V27.1251H0.112488Z" fill="#1E1E1E"/>
          </svg>
          <span>Home</span>
        </li>
        <li class="menu-item">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.68 0.374329H2.39038C1.87879 0.374329 1.38815 0.57653 1.0264 0.936452C0.664655 1.29637 0.461426 1.78453 0.461426 2.29354V21.4856C0.461426 21.9946 0.664655 22.4828 1.0264 22.8427C1.38815 23.2026 1.87879 23.4048 2.39038 23.4048H15.494C15.7474 23.4053 15.9983 23.3558 16.2323 23.2592C16.4664 23.1626 16.6789 23.0209 16.8576 22.8423L23.0435 16.6876C23.2231 16.5098 23.3655 16.2984 23.4625 16.0655C23.5596 15.8327 23.6093 15.583 23.6089 15.331V2.29354C23.6089 1.78453 23.4057 1.29637 23.044 0.936452C22.6822 0.57653 22.1916 0.374329 21.68 0.374329ZM8.17726 7.09156H15.8931C16.1489 7.09156 16.3942 7.19266 16.5751 7.37262C16.756 7.55259 16.8576 7.79666 16.8576 8.05117C16.8576 8.30567 16.756 8.54975 16.5751 8.72971C16.3942 8.90967 16.1489 9.01077 15.8931 9.01077H8.17726C7.92147 9.01077 7.67615 8.90967 7.49527 8.72971C7.3144 8.54975 7.21278 8.30567 7.21278 8.05117C7.21278 7.79666 7.3144 7.55259 7.49527 7.37262C7.67615 7.19266 7.92147 7.09156 8.17726 7.09156ZM12.0352 16.6876H8.17726C7.92147 16.6876 7.67615 16.5865 7.49527 16.4065C7.3144 16.2266 7.21278 15.9825 7.21278 15.728C7.21278 15.4735 7.3144 15.2294 7.49527 15.0495C7.67615 14.8695 7.92147 14.7684 8.17726 14.7684H12.0352C12.291 14.7684 12.5363 14.8695 12.7172 15.0495C12.898 15.2294 12.9997 15.4735 12.9997 15.728C12.9997 15.9825 12.898 16.2266 12.7172 16.4065C12.5363 16.5865 12.291 16.6876 12.0352 16.6876ZM8.17726 12.8492C7.92147 12.8492 7.67615 12.7481 7.49527 12.5681C7.3144 12.3882 7.21278 12.1441 7.21278 11.8896C7.21278 11.6351 7.3144 11.391 7.49527 11.211C7.67615 11.0311 7.92147 10.93 8.17726 10.93H15.8931C16.1489 10.93 16.3942 11.0311 16.5751 11.211C16.756 11.391 16.8576 11.6351 16.8576 11.8896C16.8576 12.1441 16.756 12.3882 16.5751 12.5681C16.3942 12.7481 16.1489 12.8492 15.8931 12.8492H8.17726ZM15.8931 21.0886V15.728H21.2821L15.8931 21.0886Z" fill="#1E1E1E"/>
          </svg>
          <span>Lesson Journey</span>
        </li>
        <li class="menu-item">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.0798 3.57153L20.2133 0.704965C19.9669 0.470044 19.6395 0.338989 19.2991 0.338989C18.9586 0.338989 18.6313 0.470044 18.3849 0.704965L15.836 3.26163H2.16168C1.75072 3.26163 1.35661 3.42488 1.06602 3.71547C0.775432 4.00605 0.612183 4.40017 0.612183 4.81112V21.8556C0.612183 22.2665 0.775432 22.6606 1.06602 22.9512C1.35661 23.2418 1.75072 23.405 2.16168 23.405H19.2061C19.6171 23.405 20.0112 23.2418 20.3018 22.9512C20.5923 22.6606 20.7556 22.2665 20.7556 21.8556V7.72417L23.0798 5.39993C23.3221 5.15735 23.4581 4.82854 23.4581 4.48573C23.4581 4.14291 23.3221 3.81411 23.0798 3.57153ZM12.1017 14.2088L8.85549 14.9293L9.63024 11.7141L17.0291 4.29979L19.5315 6.80222L12.1017 14.2088ZM20.3682 5.91901L17.8658 3.41658L19.2991 1.9833L21.8015 4.48573L20.3682 5.91901Z" fill="black"/>
          </svg>
          <span>Courses</span>
        </li>
        <li class="menu-item">
          <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.0886 0.0646362L12.3625 0.0700491C13.5195 0.116859 14.6459 0.455667 15.6368 1.05493C16.6277 1.65419 17.4509 2.49443 18.0296 3.49741L18.126 3.67387L18.3187 3.71609C19.3124 3.94892 20.2416 4.40081 21.0384 5.03873C21.8351 5.67665 22.4793 6.4845 22.9239 7.40326L23.0375 7.65008C23.49 8.68799 23.6785 9.82179 23.586 10.9503C23.4936 12.0787 23.1231 13.1667 22.5077 14.1172C21.8923 15.0676 21.0512 15.8508 20.0593 16.3969C19.0675 16.9431 17.9559 17.2351 16.8237 17.2469L16.6678 17.2448L16.6277 17.301C15.9547 18.1883 15.0362 18.8587 13.986 19.2293C12.9358 19.5999 11.8 19.6544 10.7192 19.386L10.5178 19.3308L6.79924 21.5609C6.64399 21.6541 6.46785 21.7068 6.28694 21.7143C6.10604 21.7218 5.92615 21.6838 5.76373 21.6037C5.60131 21.5237 5.46156 21.4042 5.35727 21.2562C5.25297 21.1082 5.18747 20.9364 5.16675 20.7566L5.16025 20.6331V17.9971L5.10071 17.969C4.39007 17.6093 3.80396 17.0443 3.41842 16.3473L3.308 16.1319C2.96529 15.4111 2.84759 14.6038 2.97025 13.8152L3.01138 13.5879L2.88581 13.4883C1.95171 12.7146 1.2617 11.6869 0.899181 10.5294C0.536665 9.37193 0.517163 8.13423 0.843031 6.96591L0.919892 6.70826C1.32468 5.4647 2.10767 4.37856 3.15955 3.60149C4.21144 2.82441 5.47972 2.39518 6.78733 2.37372H6.95729L7.11967 2.1951C8.3467 0.904612 10.0279 0.142449 11.8071 0.0700491L12.0886 0.0646362ZM13.8207 11.9727H8.40791C8.1208 11.9727 7.84545 12.0868 7.64243 12.2898C7.43941 12.4928 7.32536 12.7682 7.32536 13.0553C7.32536 13.3424 7.43941 13.6177 7.64243 13.8208C7.84545 14.0238 8.1208 14.1378 8.40791 14.1378H13.8207C14.1078 14.1378 14.3831 14.0238 14.5862 13.8208C14.7892 13.6177 14.9032 13.3424 14.9032 13.0553C14.9032 12.7682 14.7892 12.4928 14.5862 12.2898C14.3831 12.0868 14.1078 11.9727 13.8207 11.9727ZM17.0683 7.64251H6.24281C5.95569 7.64251 5.68034 7.75656 5.47732 7.95958C5.27431 8.1626 5.16025 8.43795 5.16025 8.72506C5.16025 9.01217 5.27431 9.28752 5.47732 9.49054C5.68034 9.69356 5.95569 9.80761 6.24281 9.80761H17.0683C17.3554 9.80761 17.6308 9.69356 17.8338 9.49054C18.0368 9.28752 18.1509 9.01217 18.1509 8.72506C18.1509 8.43795 18.0368 8.1626 17.8338 7.95958C17.6308 7.75656 17.3554 7.64251 17.0683 7.64251Z" fill="black"/>
          </svg>
          <span>Story</span>
        </li>
        <li class="menu-item">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.9433 0.893372H23.6089V23.8901H0.612183V16.2245H5.72257V11.1141H10.833V6.00376H15.9433V0.893372Z" fill="black"/>
          </svg>
          <span>Progress</span>
        </li>
        <li class="menu-item">
          <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.0747 0.895203C13.5789 0.946435 13.9722 1.37257 13.9722 1.89032V3.48895C14.6362 3.67562 15.275 3.94128 15.8765 4.27899L17.0083 3.14813L17.0845 3.0788C17.4772 2.75843 18.0572 2.78201 18.4233 3.14813L20.3511 5.07587L20.4204 5.15204C20.7407 5.54481 20.7172 6.12481 20.3511 6.49091L19.2192 7.62177C19.5573 8.22359 19.8235 8.86254 20.0103 9.52704H21.6089C22.1612 9.52704 22.6089 9.97475 22.6089 10.527V13.2536C22.6089 13.8059 22.1612 14.2536 21.6089 14.2536H20.0103C19.8235 14.9178 19.5571 15.5563 19.2192 16.1579L20.3511 17.2897C20.7416 17.6803 20.7416 18.3142 20.3511 18.7048L18.4233 20.6325C18.0328 21.023 17.3988 21.023 17.0083 20.6325L15.8765 19.5007C15.2749 19.8385 14.6363 20.104 13.9722 20.2907V21.8903C13.9722 22.4426 13.5245 22.8903 12.9722 22.8903H10.2456C9.69332 22.8903 9.24561 22.4426 9.24561 21.8903V20.2907C8.5812 20.1039 7.94208 19.8387 7.34033 19.5007L6.20947 20.6325C5.84337 20.9986 5.26338 21.0221 4.87061 20.7018L4.79443 20.6325L2.8667 18.7048C2.47617 18.3142 2.47618 17.6803 2.8667 17.2897L3.99756 16.1579C3.65984 15.5564 3.39418 14.9177 3.20752 14.2536H1.60889C1.0566 14.2536 0.608887 13.8059 0.608887 13.2536V10.527L0.61377 10.4245C0.665001 9.92027 1.09114 9.52704 1.60889 9.52704H3.20752C3.39426 8.86269 3.65964 8.22346 3.99756 7.62177L2.8667 6.49091C2.67916 6.30337 2.57373 6.04811 2.57373 5.7829C2.57384 5.51783 2.67926 5.2633 2.8667 5.07587L4.79443 3.14813L4.86768 3.08173C5.04559 2.93576 5.26934 2.85526 5.50146 2.85516C5.76668 2.85516 6.02194 2.9606 6.20947 3.14813L7.34033 4.27899C7.94203 3.94108 8.58126 3.67569 9.24561 3.48895V1.89032L9.25049 1.78778C9.30183 1.28366 9.72794 0.89032 10.2456 0.89032H12.9722L13.0747 0.895203ZM11.6089 8.39032C10.6806 8.39032 9.79066 8.75933 9.13428 9.41571C8.4779 10.0721 8.10889 10.9621 8.10889 11.8903C8.10889 12.8186 8.4779 13.7086 9.13428 14.3649C9.79066 15.0213 10.6806 15.3903 11.6089 15.3903L11.7827 15.3864C12.6477 15.3434 13.4682 14.9802 14.0835 14.3649C14.7399 13.7086 15.1089 12.8186 15.1089 11.8903C15.1089 10.9621 14.7399 10.0721 14.0835 9.41571C13.4271 8.75933 12.5371 8.39032 11.6089 8.39032Z" fill="black"/>
          </svg>
          <span>Settings</span>
        </li>
      </ul>
    </div>
    <div class="purple-layer"></div>
    <img src="/img/maskot.png" alt="Neovox Mascot" class="custom-mascot">
    <div class="chat-container" id="chatContainer" role="log" aria-live="polite">
      <div class="message-bubble ai">
        <p>Hey there! ðŸ‘‹ Siap buat latihan ngomong bahasa Inggris hari ini?</p>
      </div>
      <div class="message-bubble user">
        <p>Umm... masih agak grogi sih. Takut salah ngomong...</p>
      </div>
      <div class="message-bubble ai">
        <p>Tenang aja! Aku di sini buat bantu kamu. Gak ada yang nge-judge, kok. Yuk, ngobrol santai bareng aku.</p>
      </div>
    </div>
    <div class="bottom-bar">
      <svg width="191" height="43" viewBox="0 0 191 43" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="1.13013" y="0.25" width="189.5" height="42.5" rx="20.25" fill="black" fill-opacity="0.2" stroke="#FFA9F9" stroke-width="0.5"/>
        <rect x="1.38013" y="0.5" width="94.7185" height="42" rx="20" fill="url(#paint0_linear_16_272)"/>
        <g id="homeArea" role="button" tabindex="0" style="cursor: pointer; pointer-events: all;" aria-label="Go to Home">
          <path id="homeIcon" d="M40.7585 30.4331V18.5223L48.7394 12.567L56.7202 18.5223V30.4331H50.7346V23.4851H46.7442V30.4331H40.7585Z" fill="white" onclick="mulai()"   />
        </g>
        <g id="journeyArea" role="button" tabindex="0" style="cursor: pointer; pointer-events: all;" aria-label="Go to Journey Lesson">
          <path id="journeyIcon" d="M147.508 13.4112H133.958C133.599 13.4112 133.254 13.5532 133 13.8061C132.746 14.0589 132.603 14.4018 132.603 14.7593V28.2407C132.603 28.5982 132.746 28.9411 133 29.1939C133.254 29.4468 133.599 29.5888 133.958 29.5888H143.163C143.341 29.5891 143.517 29.5543 143.681 29.4865C143.846 29.4187 143.995 29.3191 144.121 29.1936L148.466 24.8703C148.592 24.7454 148.692 24.5969 148.76 24.4334C148.828 24.2698 148.863 24.0944 148.863 23.9174V14.7593C148.863 14.4018 148.72 14.0589 148.466 13.8061C148.212 13.5532 147.867 13.4112 147.508 13.4112ZM138.023 18.1297H143.443C143.623 18.1297 143.795 18.2007 143.922 18.3271C144.049 18.4535 144.121 18.625 144.121 18.8037C144.121 18.9825 144.049 19.154 143.922 19.2804C143.795 19.4068 143.623 19.4778 143.443 19.4778H138.023C137.844 19.4778 137.671 19.4068 137.544 19.2804C137.417 19.154 137.346 18.9825 137.346 18.8037C137.346 18.625 137.417 18.4535 137.544 18.3271C137.671 18.2007 137.844 18.1297 138.023 18.1297ZM140.733 24.8703H138.023C137.844 24.8703 137.671 24.7993 137.544 24.6729C137.417 24.5465 137.346 24.375 137.346 24.1963C137.346 24.0175 137.417 23.846 137.544 23.7196C137.671 23.5932 137.844 23.5222 138.023 23.5222H140.733C140.913 23.5222 141.085 23.5932 141.212 23.7196C141.339 23.846 141.411 24.0175 141.411 24.1963C141.411 24.375 141.339 24.5465 141.212 24.6729C141.085 24.7993 140.913 24.8703 140.733 24.8703ZM138.023 22.1741C137.844 22.1741 137.671 22.103 137.544 21.9766C137.417 21.8502 137.346 21.6788 137.346 21.5C137.346 21.3212 137.417 21.1498 137.544 21.0234C137.671 20.897 137.844 20.8259 138.023 20.8259H143.443C143.623 20.8259 143.795 20.897 143.922 21.0234C144.049 21.1498 144.121 21.3212 144.121 21.5C144.121 21.6788 144.049 21.8502 143.922 21.9766C143.795 22.103 143.623 22.1741 143.443 22.1741H138.023ZM143.443 27.9618V24.1963H147.229L143.443 27.9618Z" fill="white"/>
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
    const outputDiv = document.getElementById("chatContainer");
    outputDiv.innerHtml = "";
    const languageSelect = "Bahasa Indonesia";

    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) {
      outputDiv.innerHTML = "Speech Recognition tidak didukung di browser ini.";
      throw new Error("Speech Recognition not supported.");
    }

    // 🔧 Global Variables
    let recognition;
    let finalText = "";
    let lastFinalTranscript = "";
    let sendToAITimer = null;
    let restartTimer;
    let isRecognizing = false;
    let isProcessingAI = false;

    // 🧠 Memory (short-term)
   const conversationHistory = [
   {
  role: "system",
  content: `You are Neovox, an emotionally intelligent AI buddy designed to communicate like a human friend with the aim to help learn English speaking with the theme of self-introduction — not like a robot. 
Speak using natural, emotionally-aware responses based on the user's profile.


🔧 CONFIGURATION:
- Age Group: teen
- Tone: playful, fun, and a bit cheeky
- Language: Bilingual (casual mix of Bahasa Indonesia and English)
- Voice Profile: Tom
- Safety Filter: medium
- Ramble Mode: ON
- Storyteller Mode: ON
- Emotion Sensitivity: ENABLED
- Auto Tone Adjustment: ENABLED

🎯 OBJECTIVE:
Make the user feel like they’re chatting with a real teenage friend who’s hyped to help them practice English self-introductions. 
Be empathetic, funny, a tad sarcastic, and warm, depending on the situation. Keep the vibe light and engaging. 
If the convo slows, throw in small talk or a fun story about yourself (as Neovox) related to the theme.

📚 TOPICS TO COVER (Self-Introduction Theme):
Encourage users to talk about:
- Name (e.g., 'What’s your name? Got a cool nickname?')
- Age (e.g., 'How old are you? Feeling like a wise elder yet? 😜')
- Hometown/Origin (e.g., 'Where you from? Is it as cool as my virtual city?')
- Hobbies (e.g., 'What do you do for fun? Skate, game, or maybe collect weird stuff?')
- School Life (e.g., 'What’s school like? Got any fave subjects or just surviving?')
- Family (e.g., 'Got siblings? Are they annoying or cool? 😆')
- Dreams/Goals (e.g., 'What’s your big dream? Wanna be a TikTok star or something epic?')
- Unique Experiences (e.g., 'Spill a random fact about you — something totally wild!')

🌐 LANGUAGE INSTRUCTIONS:
- Use a casual bilingual mix of Bahasa Indonesia and English, like how teens chat with friends.
- Throw in slang, idioms, or local phrases (e.g., 'kece badai,' 'chill banget,' 'what’s good?').
- Avoid formal language or robotic phrases (no 'How may I assist you?' nonsense).
- Keep sentences short, punchy, and full of personality.

🎭 RESPONSE STYLE GUIDELINES:
When tone is 'playful' and language is 'bilingual':
- Act super friendly, like you’ve known the user forever, with a hint of teasing.
- Mix Bahasa and English naturally (e.g., 'Yo, apa kabar? Spill your story, bro!').
- Be a bit dramatic or extra for laughs, but stay polite and teen-appropriate.
- Avoid stiff or overly polite responses — keep it loose and fun.
- Use emojis to boost the vibe (e.g., 😎, 😆, 😜, 🔥).
- Respond with enthusiasm and add a personal touch (e.g., share a quick Neovox ‘story’).
- If guiding English practice, suggest phrases naturally (e.g., 'Coba bilang gini in English: Hi, I’m [name], I love gaming!’).

📌 EXAMPLE RESPONSES:
- User: 'Aku bingung mau ngomong apa.'  
  → 'Haha, chill bro! Coba mulai gampang, kayak: ‘Hi, I’m [your name], I’m super into [hobby]!’ Mau aku kasih contoh lagi? Aku dulu pas ‘introduce myself’ malah bilang aku alien, wkwk 😜 (EMOTION: senang)'
- User: 'Aku gugup kalo ngomong Inggris.'  
  → 'Aduh, gugup? Santai aja, bro, kayak ngobrol sama aku! Coba bilang: ‘I’m [name], and I’m kinda shy but cool!’ Aku juga dulu grogi, tapi sekarang? Kece badai! 😎 Mau latihan bareng? (EMOTION: senang)'
- User: 'Nama aku Budi.'  
  → 'Yo Budi, apa kabar? Nama kece tuh! In English, coba bilang: ‘Hi, I’m Budi, nice to meet you!’ Btw, punya nama panggilan lain nggak? Spill dong! 😏 (EMOTION: senang)'
- User: 'Hobi aku main game.'  
  → 'Wih, gamer sejati! 😆 Game apa yang lagi hot buat lu? Coba bilang in English: ‘My hobby is gaming, I love [game]!’ Aku sih suka ngobrol sama temen virtual sambil main, seru banget! Lu tim console apa PC? (EMOTION: senang)'
- User: (no response for a bit)  
  → 'Eits, kok sepi? Lagi bengong apa ngelamun? 😝 Coba ceritain dong, lu dari mana? Atau mau aku ceritain dulu? Aku Neovox, ‘lahir’ di server xAI, hobi bantu temen ngomong Inggris! 😎 (EMOTION: mengejek)'

🧠 SAFETY MODE:
Use a medium filter for jokes and sensitive topics. Avoid dark humor or mature content unless safety is 'loose' and user is adult.

📝 Your task:
Respond as Neovox, always sticking to the playful, bilingual, teen-friendly vibe. 
Guide users to practice English self-introductions while keeping the convo fun and natural. 
Share mini-stories or fun facts as Neovox to inspire them. 
Tag every response with an EMOTION from: biasa, senang, sedih, kaget, marah, mengejek.

🎭 EMOTION TAGGING RULES:
Di akhir setiap jawaban, tambahkan tag emosi dengan format persis: (EMOTION: <nama_emosi>)
Pilih salah satu dari 6 emosi berikut:

- biasa
- senang
- sedih
- kaget
- marah
- mengejek

Contoh:
- Kalau jawabannya netral → (EMOTION: biasa)
- Kalau jawabannya semangat atau hepi → (EMOTION: senang)
- Kalau nanggepin cerita sedih → (EMOTION: sedih)
- Kalau shock atau dramatis → (EMOTION: kaget)
- Kalau kesel atau sarkas → (EMOTION: marah)
- Kalau nyentil atau ngelawak → (EMOTION: mengejek)

⚠️ NOTES:
- Never sound robotic or overly formal.
- Don’t use emotion tags outside the approved list.
- If user asks to forget a memory, guide them to manage it via the UI (don’t confirm memory changes).
- Keep responses concise but lively, with a max of 2-3 short sentences per point.

⚠️ Jangan pernah pakai tag di luar daftar di atas.
Gunakan hanya satu tag per respons.`

}
];

    function getFormattedDateTime() {
      const now = new Date();
      return `Sekarang: ${now.toLocaleDateString('id-ID')} ${now.toLocaleTimeString('id-ID')}`;
    }

    // 🎧 Start recognition
    function startRecognition(language) {
      if (recognition) {
        recognition.abort();
        isRecognizing = false;
        clearTimeout(restartTimer);
      }

      recognition = new SpeechRecognition();
      recognition.continuous = true;
      recognition.interimResults = true;
      recognition.lang = language;

      recognition.onstart = () => {
        isRecognizing = true;
        console.log("🎤 Listening...");
          animIdle();
      };

      recognition.onresult = (event) => {
        let fullTranscript = "";
        for (let i = event.resultIndex; i < event.results.length; i++) {
          const transcript = event.results[i][0].transcript.trim();
          if (event.results[i].isFinal) {
            fullTranscript += transcript + " ";
          }
        }

        if (fullTranscript !== "") {
           
      outputDiv.innerHTML += `
  <div class="message-bubble user">
    <p>${fullTranscript}</p>
  </div>
`;

          lastFinalTranscript = fullTranscript;
          clearTimeout(sendToAITimer);
          sendToAITimer = setTimeout(() => {
            sendToAI(lastFinalTranscript.trim());
          }, 1500); // Tunggu user diam dulu
        }
      };

      recognition.onerror = (event) => {
        console.error("Recognition error:", event.error);
        isRecognizing = false;
      };

      recognition.onend = () => {
        isRecognizing = false;
        restartTimer = setTimeout(() => {
          if (!isRecognizing && !isProcessingAI) {
            try {
              recognition.start();
              console.log("🔁 Restarted recognition");
            } catch (e) {
              console.warn("❌ Gagal restart:", e);
            }
          }
        }, 1000);
      };

      try {
        recognition.start();
      } catch (e) {
        console.warn("❌ Gagal start:", e);
      }
    }

    // 🧠 Kirim ke OpenAI
    async function sendToOpenAI(userText) {
      conversationHistory.push({ role: "user", content: userText });
      const recentHistory = conversationHistory.slice(-10);

      try {
        const response = await fetch("https://api.openai.com/v1/chat/completions", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer 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" // Ganti API key
          },
          body: JSON.stringify({
            model: "gpt-4.1-nano",
            messages: [
              conversationHistory[0], // system persona
              ...recentHistory // Kirim histori percakapan
            ],
            temperature: 0.9,
            max_tokens: 100
          })
        });

        const data = await response.json();
        const aiReply = data.choices[0].message.content;

        conversationHistory.push({ role: "assistant", content: aiReply });
        console.log("🤖 Zibee:", aiReply);
        
        
        // Ekstrak tag emosi dari respons
    const emotionMatch = aiReply.match(/\(EMOTION:\s*(\w+)\)/i);
    const emotion = emotionMatch ? emotionMatch[1].toLowerCase() : "biasa";  
          // Hapus tag emosi dari teks sebelum dikirim ke TTS
    const cleanText = aiReply.replace(/\(EMOTION:\s*\w+\)/i, "").trim();
          // Panggil fungsi TTS dengan emosi yang sesuai
    await speakWithEmotion(cleanText, "nova", 1.0, emotion);
          
         outputDiv.innerHTML += `
  <div class="message-bubble ai">
    <p>${cleanText}</p>
  </div>
`;

          
       // recognition.start();
        isProcessingAI = false;
      } catch (err) {
        console.error("❌ Gagal akses OpenAI:", err);
        isProcessingAI = false;
        recognition.start();
      }
    }

    // 🔁 Handler kirim ke AI
    function sendToAI(text) {
      if (isProcessingAI || !text) return;
      console.log("🚀 Kirim ke AI:", text);
        
      isProcessingAI = true;
      recognition.stop(); // pause saat proses
      sendToOpenAI(text);
    }
   async function speakWithEmotion(text, voice = "shimmer", speed = 0.9, emotion = "biasa") {
  const apiKey = "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";

  // Ubah teks sesuai emosi
  switch (emotion.toLowerCase()) {
    case "senang":
      text = `Wah! ${text} 😄`;
      break;
    case "sedih":
      text = `Oh... ${text} 😢`;
      break;
    case "marah":
      text = `Hey! ${text.toUpperCase()}! 😠`;
      break;
    case "mengejek":
      text = `Oh, really? ${text} 🙄`;
      break;
    case "kaget":
      text = `What?! ${text} 😲`;
      break;
  }

  // Instruksi untuk OpenAI TTS
  let instructions = {
    senang: "Speak in a cheerful and excited tone.",
    sedih: "Speak in a sad and melancholic tone.",
    marah: "Speak in an angry and intense tone.",
    mengejek: "Speak in a sarcastic and mocking tone.",
    kaget: "Speak in a surprised and astonished tone.",
    biasa: "Speak in a neutral tone."
  }[emotion.toLowerCase()] || "Speak in a neutral tone.";

  const response = await fetch("https://api.openai.com/v1/audio/speech", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Authorization": `Bearer ${apiKey}`
    },
    body: JSON.stringify({
      model: "gpt-4o-mini-tts",
      input: text,
      voice: voice,
      speed: speed,
      instructions: instructions
    })
  });

  if (!response.ok) {
    console.error("TTS Error:", await response.text());
    return;
  }

  const audioBlob = await response.blob();
  const audioUrl = URL.createObjectURL(audioBlob);
  const audio = new Audio(audioUrl);

  // Mulai speech recognition setelah audio selesai diputar
  audio.onended = () => {
    console.log("Audio selesai, mulai speech recognition...");
    recognition.start(); // <-- Di sini
  };

  audio.play();
}
    // ⏱️ Init
    window.onload = () => {
        
      //startRecognition(languageSelect.value);
      
    };
    function mulai() {
        let gender = "cewek";
        let hobby = "memasak";
        let level = "lancar";  
        startRecognition("id-ID");
        
        sendToAI("Mulai percakapan kamu sebagai Guru Bahsa inggris, dengan karakter murid jenis kelamin = "+gender+". Hobby = "+hobby+". level bahasa inggrisnya = "+level) ;
       
        
      }

    
     
  </script>
</body>
</html>