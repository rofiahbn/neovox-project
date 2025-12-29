<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");



get('/login', 'views/auth/login.php');

post('/login', 'controllers/auth/login.php');



get('/signup', 'views/auth/signup.php');

post('/signup', 'controllers/auth/signup.php');



get('/dashboard', 'views/dashboard.php');

get('/voice-library', 'views/voice-library.php');

get('/text-to-speech', 'views/text-to-speech.php');

get('/voice-changer', 'views/voice-changer.php');

get('/sound-effects', 'views/sound-effects.php');

get('/studio', 'views/studio.php');

get('/dubbing-room', 'views/dubbing-room.php');

get('/conversational-ai', 'views/conversational-ai.php');

get('/speech-to-text', 'views/speech-to-text.php');

get('/audio-tools', 'views/audio-tools.php');

get('/notification', 'views/notification.php');

get('/profile', 'views/profile.php');

get('/learning', 'views/learning.php');

get('/assessment', 'views/assessment.php');

get('/get_cookies', 'views/get_cookies.php');

get('/config', 'views/config.php');

get('/process', 'views/api/process.php');

get('/lmnt', 'views/api/lmnt.php');

get('/ai', 'views/ai.php');
get('/scenario', 'views/scenario.php');



any('/404', 'views/404.php');

?>