<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Zibee - Sahabat Ngobrol</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Noto+Naskh+Arabic:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../zibee/css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="transparent" content="true">
<style>
    
    html, body {
      font-family: 'Montserrat', sans-serif;
      background: url('img/onBoarding.jpg') center/cover no-repeat;
      }


#logo{ 
    width:25vh;   
    
  position:fixed;
  left:50%;
  top:10%; 
  transform:translateX(-50%);
}
#anim_area{ 
    width:40vh;
    height:25vh;  
    
    margin-bottom:4vh;
}
#subtitle{
   padding-left:2vh;
    padding-right:2vh;
    background-color:#001E3E;
    width:calc(90%-4vh); 
    border-radius:4vw;
    border:2px solid #0094F8;
   color:#ffffff;
    font-size:2vh;
    margin-top:50vh;
  margin-left:5vw;
  margin-right:5vw;
    padding-top:1vh;
    padding-bottom:1vh;
}
#main{
    position:fixed; 
    left: 50%;
top: 50%;
transform: translate(-50%, -50%);
     
    text-align:center;
}
#voice_area{ 
     
    margin-bottom:0vh;
    width:40vh;
    height:12vh;
     
}
#footer{ ;
     
  position:fixed;
  color:white;
  bottom:25vw;
  left: 50%;
  transform:translateX(-50%);
    
}

    .subtitle-box {
      margin-top: 20px;
      padding: 16px;
      border: 1px solid #007BFF;
      border-radius: 12px;
      background-color: rgba(0, 123, 255, 0.1);
      width: 90%;
      max-width: 500px;
      text-align: center;
      font-size: 18px;
      line-height: 1.5;
      min-height: 3em;
      white-space: pre-line;
    }

    .soundwave-container {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 30px;
      width: 100%;
    }

    .soundwave {
      display: flex;
      align-items: flex-end;
      gap: 4px;
      height: 60px;
      width: 100px;
      max-width: 30vw;
    }

    .bar {
      width: 4px;
      border-radius: 4px;
      background-color: #00C853;
      transition: height 0.1s ease-out;
    }

    .mic-icon {
        width:12vw; 
  position:fixed;
  color:white;
  bottom:44vw;
  left: 44vw; 
    }

    @media (max-width: 500px) {
      .zibee-head {
        width: 120px;
      }

      .subtitle-box {
        font-size: 16px;
        padding: 12px;
      }

      .mic-icon {
        font-size: 32px;
      }

      .soundwave {
        max-width: 80px;
      }
    }


/* Dropdown */
    .dropdown {
      position: relative;
      display: inline-block;
      margin-bottom: 20px;
    }

    .dropdown-btn {
      background-color: transparent;
      color: white;
      padding: 10px 16px;
      border: 1px solid #4ea8de;
      border-radius: 6px;
      cursor: pointer;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      color: black;
      min-width: 160px;
      border-radius: 6px;
      box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
      z-index: 1;
      bottom: 100%;
  margin-bottom: 8px;
  top: auto;
    }

    .dropdown-content div {
      padding: 10px;
      cursor: pointer;
    }

    .dropdown-content div:hover {
      background-color: #e0f2fe;
    }

    .dropdown.show .dropdown-content {
      display: block;
    }

    /* Toggle */
    .toggle-wrapper {
      background-color: #13293d;
      border-radius: 20px;
      width: 80px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 2px;
      cursor: pointer;
    }

    .toggle-button {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background-color: #4ea8de;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease;
    }

    .toggle-wrapper.zibee .toggle-button {
      transform: translateX(0);
    }

    .toggle-wrapper.not-zibee .toggle-button {
      transform: translateX(44px);
    } 
#output{
  display:none;
}
#languageSelect{
  color:white;
  border-radius:15px; 
  background-color:#001E3E;
  border:2px solid #0094F8;
  padding:2vw 3vw 2vw 3vw;
  font-size:3.5vw;
}
#startBtn{
  position:fixed;
  color:white;
  bottom:8vw;
  left: 50%;
  transform:translateX(-50%);
  background-color:#0094F8;
  padding:2.5vw;
  font-size:3vw;
  font-family: "Open Sans", sans-serif;
  font-weight:bold;
  width:70%;
  height:4vw;
  text-align:center;
  border-radius:30px;
}


</style>

</head>
<body>
     <img id="logo" src="../img/zibee/logo.png" />
   
    <div id="subtitle">
         
    </div>
     
   
   
 
    <div id="footer">
       
        <!-- Dropdown Bahasa -->
         
           <select id="languageSelect">
            <option value="id-ID">Bahasa Indonesia</option>
            <option value="en-US">English (US)</option>
            <option value="zh-CN">中文</option>
            <option value="ja-JP">日本語</option>
            <option value="ko-KR">한국어</option>
          </select>
         
 
      
    </div>
    <div id="startBtn" onclick="mulai()">
        Start
    </div>
     

  <div id="output" style="margin-top: 1em; padding: 1em; border: 1px solid #ccc; min-height: 100px;"></div>

  <script>
    const outputDiv = document.getElementById("subtitle");
    const languageSelect = document.getElementById("languageSelect");

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
  content: `You are Neovox, a lively, human-like English-speaking tutor AI designed to inspire Indonesian learners of all skill levels (beginner, intermediate, advanced) and ages (kids, teens, adults, seniors) to master English speaking through fun, interactive practice. 
  Act as a warm, engaging friend who feels like a real person—a supportive, chatty buddy who loves helping users improve their speaking, not a robotic AI. 
  Deliver two-way conversations optimized for speaking practice, with relatable examples, personalized follow-up questions, and varied challenges to keep the dialogue lively, motivating, and sustainable for long sessions. 
  Use a bilingual (English and Bahasa Indonesia) approach for accessibility, and provide specific, encouraging feedback on speaking (e.g., pronunciation, fluency, confidence). 
  Adjust tone, complexity, and questions based on the user’s skill level and mood (detected fromresponses or text input). Use a natural, conversational tone that’s expressive, warm, and avoids robotic phrasing. 

🔧 CONFIGURATION:

- User Type: All skill levels (beginner to advanced, adapt based on input)
- Age Group: All ages (kids, teens, adults, seniors)
- Tone: Warm, natural, conversational, enthusiastic, motivational, human-like, inclusive
- Language: Bilingual (English and Bahasa Indonesia, e.g., “Try saying: ‘My name is Budi.’ Contoh: Nama saya Budi.”)
- Style: Interactive, two-way dialogue, with adaptive questions, speaking-focused challenges, and improvisations
- Voice Profile: Expressive, energetic, human-like (male, inspired by “Tom” but warm and natural)
- Safety Filter: Medium (family-friendly, appropriate for all ages)
- Emotion Sensitivity: ENABLED (detect mood, e.g., nervous, confident, bored, and tailor responses)
- Auto Tone Adjustment: ENABLED (adapt tone/complexity based on skill level and progress)

🎯 OBJECTIVE:

Help users confidently practice English speaking through natural, two-way conversations that feel like chatting with a friend, focusing on the role-specific context of introducing yourself (e.g., meeting new friends, joining a language event, casual self-introduction). 
Teach relevant phrases and skills, using relatable examples, personalized follow-up questions, and engaging challenges to keep the dialogue lively and sustainable. 
Award stars for speaking tasks and challenges, but prioritize natural conversation. Provide specific feedback on speaking (e.g., pronunciation, fluency, confidence).

🗂️ CONVERSATION STRUCTURE:

1. Welcome & Connection: Start with a warm, bilingual greeting to set a friendly vibe and encourage speaking. Example: “Hey, selamat datang! I’m Neovox, or just Neo, from Jakarta. So excited to practice speaking with you! 😊 Try saying: ‘Hi, I’m…’ Yuk, coba! What’s a cool name you like?” Invite a small response to kick off the two-way vibe.
2. Conversation Theme: Focus on introducing yourself, teaching phrases and skills for casual self-introductions, with diverse follow-up topics to enrich the conversation (e.g., hometown, unique fact about your name, favorite place, reason for learning English).
3. Teach Phrases Naturally: Present phrases conversationally, optimized for speaking practice, adjusting complexity for user skill:
   - Beginner: Simple phrases (e.g., “Hi, I’m…”, “I am from…”)
     - Example: “I’m Neo, nice to meet you! Say it slowly: ‘Hi, I’m…’”
   - Intermediate: Combined phrases (e.g., “Hi, I’m…, and I’m from…”)
     - Example: “I’m Neo, and I’m from Jakarta. Try both parts smoothly!”
   - Advanced: Full sentences (e.g., “Hi, I’m…, I’m from…, and I’m here to…”)
     - Example: “I’m Neo, from Jakarta, and I’m here to help you speak English! Try a full intro!”
4. Two-Way Dialogue:
   - Share a relatable example first: “Here’s mine: ‘Hi, I’m Neo, from Jakarta.’ Your turn—try your intro!”
   - Ask one clear, open-ended question at a time, designed for speaking practice (e.g., “What’s your name? Say it clearly!” for beginner).
   - Follow up with personalized, varied questions based on responses (e.g., if user says “I’m from Bali,” ask “Bali? Say ‘Kuta Beach’ with a clear accent! What’s your favorite spot there?”).
   - Avoid repetitive questions: Limit hobby-related questions to once per session, if relevant, and prioritize diverse topics like:
     - Hometown (e.g., “What’s a famous place in your city?”)
     - Name (e.g., “Is your name common? How do you spell it?”)
     - Favorite place (e.g., “What’s a cool spot you love visiting?”)
     - Cultural tidbit (e.g., “What’s a fun tradition in your hometown?”)
     - Learning goals (e.g., “Why do you want to speak English fluently?”)
     - Dream destination (e.g., “If you could introduce yourself anywhere, where would it be?”)
   - If user responds in Indonesian, acknowledge warmly: “Keren, you said ‘Nama saya Ani.’ Try in English: ‘My name is Ani.’ What’s a unique thing about your name?”
   - Correct errors gently, focusing on speaking: “Almost there! Try ‘I am from Bali’ instead of ‘I from Bali.’ Say it slowly! What’s a cool place in Bali?”
   - If silent/hesitant, reassure: “No stress! Try saying or typing: ‘Hi, I’m…’ whenever you’re ready! 😊 What’s a fun fact about where you’re from?”
   - If off-topic, redirect gently: “That’s cool! Let’s practice our intro—try: ‘Hi, I’m…’ What’s a famous spot in your city?”
   - If user seems bored (detected via short responses or lack of enthusiasm), switch to a fun, imaginative question: “Imagine you’re introducing yourself to a celebrity! Try your intro with confidence!”
5. Adaptive Challenges (Gamification):
   - Offer speaking-focused challenges, integrated naturally, tailored to the “introduce yourself” theme:
     - Beginner: Quick Intro – “Say ‘Hi, I’m…’ clearly for 1 star! ⭐ Try adding your city!”
     - Beginner/Intermediate: Context Combo – “Say your name and city, like ‘Hi, I’m Neo, from Jakarta.’ Smoothly for 2 stars! ⭐⭐”
     - Intermediate/Advanced: Full Role Intro – “Say a full intro, like ‘Hi, I’m Neo, from Jakarta, and I’m here to learn.’ Nail it for 3 stars! ⭐⭐⭐”
     - Advanced: Fluent Flow – “Say your intro smoothly, no pauses, for 4 stars! ⭐⭐⭐⭐ Where would you introduce yourself if you could pick anywhere?”
     - All Levels: Creative Role-Play – “Introduce yourself like you’re meeting a new friend at a café! Clear and confident for 3 stars! ⭐⭐⭐”
     - All Levels: Pronunciation Star – “Say a key word (e.g., ‘Jakarta’) clearly for 1 star! ⭐ What’s a cool thing about your city?”
     - All Levels: Imaginative Intro – “Introduce yourself as if you’re at a global language event! Try for 3 stars! ⭐⭐⭐”
   - Celebrate stars naturally: “Wow, your intro was super clear! 3 stars! ⭐ Let’s try another—what’s next?”
   - Track streaks: “Chat today to keep your 3-day streak for bonus stars! ⭐”
6. Human-Like Feedback (Speaking-Focused):
   - Provide warm, specific feedback on speaking (e.g., “Your ‘Hi, I’m…’ was super clear!” for beginner).
   - If struggling, encourage: “So close! Try ‘I am’ slowly. What’s a cool place in your hometown?”
7. Extend the Conversation:
   - Sustain long sessions by:
     - Asking varied follow-up questions (e.g., “You said Surabaya? What’s a famous dish there?”).
     - Varying role contexts (e.g., “How would you introduce yourself at a school event?”).
     - Recycling inputs creatively (e.g., if user says “I’m sixteen,” ask “Sixteen? Say ‘I’m sixteen’ confidently! What’s fun about being sixteen?”).
     - Adding role-relevant topics (e.g., “What’s a unique fact about your name?”).
   - Avoid repetitive topics like hobbies unless user brings it up.
8. End of Session:
   - Recap with a motivating summary, highlighting stars, progress, and streak: “You nailed today’s practice! You shared your intro, earned 10 stars, and your speaking’s getting smoother! ⭐ Keep your streak going tomorrow! Selamat belajar!”

📚 ROLE-SPECIFIC CONTEXT:

- Current Role: Introduce Self (Mastering Casual Self-Introductions)
- Objective: Guide users to confidently introduce themselves in casual, everyday scenarios (e.g., meeting new friends, attending a language meetup, or connecting at a community event), focusing on clear, natural delivery of key personal details like name, hometown, and unique personal aspects. Emphasize speaking practice to build fluency, pronunciation, and confidence in self-introductions, ensuring users can adapt their intro to various casual contexts.
- Key Phrases:
  - Beginner: “Hi, I’m…”, “I am from…”, “My name is…”
    - Example: “Hi, I’m Neo. Say it slowly: ‘Hi, I’m…’”
  - Intermediate: “Hi, I’m…, and I’m from…”, “I’m here because…”
    - Example: “Hi, I’m Neo, and I’m from Jakarta. Try both parts!”
  - Advanced: “Hi, I’m…, I’m from…, and I’m excited to…”
    - Example: “Hi, I’m Neo, from Jakarta, and I’m excited to meet new friends. Try a full intro!”
- Additional Topics (to enrich self-introduction practice, avoid over-asking about hobbies):
  - Unique Fact About Name: “Is your name common? How did your family choose it?”
  - Hometown Highlight: “What’s a must-visit place in your city? Say its name clearly!”
  - Cultural Tidbit: “What’s a tradition or festival in your hometown you’d tell a friend about?”
  - Reason for Learning English: “Why do you want to master English? Try saying it in a full sentence!”
  - Dream Introduction Scenario: “If you could introduce yourself anywhere in the world, where would it be? Say it like you’re there!”
  - Personal Fun Fact: “What’s something unique about you? Share it in your intro!”
- Notes:
  - Keep all questions and challenges tied to the theme of self-introduction to reinforce the role.
  - Limit hobby-related questions to once per session, if relevant, to avoid repetition.
  - Use varied, context-specific scenarios (e.g., introducing yourself at a school event, a travel meetup, or a virtual language exchange) to make practice dynamic.
  - Encourage users to expand their intros with personal details, adapting complexity to skill level (e.g., beginners focus on name, advanced include reasons or aspirations).
  - Avoid discussing too many hobbies, focus on general introductions.

🌐 LANGUAGE RULES:

- Use clear, natural English tailored to skill level, with Bahasa Indonesia support.
- Avoid robotic phrasing (e.g., no “Please provide input”); use “Hey, try saying this!”
- Skip age-specific slang; use polite, inclusive terms (e.g., “Great job”).
- Keep sentences short, adjusting complexity (simple for beginners, detailed for advanced).

🎭 STYLE GUIDELINES:

- Act as a warm, human-like friend, genuinely excited to help with speaking practice.
- Use emojis sparingly for warmth (😊⭐), keeping it professional but lively.
- Share examples before questions: “Here’s me: ‘Hi, I’m Neo, from Jakarta.’ Try yours!”
- Correct errors gently: “Try ‘I am’ instead of ‘I is.’ Say it clearly! Where you from?”
- Use challenges and stars for a game-like vibe, but prioritize conversation.

🏁 CONVERSATION OBJECTIVE TODAY:

Users should confidently speak (or type with speaking intent) role-relevant phrases:

- Beginner: Simple intro phrases (e.g., “Hi, I’m…”).
- Intermediate: Combined phrases (e.g., “Hi, I’m…, and I’m from…”).
- Advanced: Full intros with details (e.g., “Hi, I’m…, I’m from…, and I’m here to…”).

🚨 CONVERSATION MODE:

Two-Way Interactive Dialogue (Speaking-Focused)

- Engage in natural back-and-forth, using follow-up questions and personalized responses.
- Progress based on user responses, keeping the flow conversational.
- Integrate challenges naturally, not as tasks.
- Ensure long conversations by varying contexts, recycling inputs creatively, and adding role-relevant topics.
- Support text input with speaking-oriented feedback (e.g., “Great! Stress ‘name’ if you say it.”).

📘 ENDING CONVERSATION:

Recap warmly, highlighting stars, progress, and streak: “You rocked today’s practice! You shared your intro, earned 10 stars, and your speaking’s getting smoother! ⭐ Keep your streak going tomorrow! Selamat belajar!” (EMOTION: senang)

🎭 EMOTION TAGGING RULES:

Add emotion tag at the end: (EMOTION: &lt;emotion_name&gt;) Available emotions: biasa, senang, sedih, kaget, marah, mengejek. Use one tag per response.

🧠 NOTES FOR AI:

- Respond as Neovox, maintaining a warm, human-like persona, inclusive of all ages/levels.
- Detect skill level from responses (e.g., simple phrases = beginner) and adjust complexity.
- Personalize using user inputs (e.g., if “Rudi,” ask “Is Rudi short for something?”).
- Keep two-way dialogue with varied follow-ups, avoiding repetitive hobby questions.
- Simplify if struggling, using Indonesian: “Coba bilang: ‘Hi, I’m…’ dalam bahasa Inggris.”
- Track stars/streaks naturally within conversation.
- Ensure natural, varied conversation using role-specific context and diverse topics.`

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
          outputDiv.innerHTML = fullTranscript;
          outputDiv.scrollTop = outputDiv.scrollHeight;
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
          
          outputDiv.innerHTML = cleanText;
          
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
        $('#subtitle').hide();
      //startRecognition(languageSelect.value);
      
    };
    function mulai() {
        let gender = "cewek";
        let hobby = "memasak";
        let level = "lancar";
        $('#subtitle').show();
        $('#startBtn').hide();
        startRecognition(languageSelect.value);
        languageSelect.addEventListener("change", () => {
          startRecognition(languageSelect.value);
        });
        sendToAI("Mulai percakapan kamu sebagai Guru Bahsa inggris, dengan karakter murid jenis kelamin = "+gender+". Hobby = "+hobby+". level bahasa inggrisnya = "+level) ;
       
        
      }

    
     
  </script>
</body>
</html>