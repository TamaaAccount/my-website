<?php
// Start PHP code if needed for any server-side logic
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> H4CK3D By ./1tsM3Tamaa</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #000;
      color: white;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      overflow: hidden;
    }

    .matrix {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: black;
      z-index: -1;
      overflow: hidden;
    }

    .matrix-canvas {
      display: block;
      width: 100%;
      height: 100%;
    }

    .container {
      text-align: center;
      position: relative;
    }

    .logo {
      position: relative;
      width: 155px;
      margin: 0 auto;
    }

    .logo img {
      width: 100%;
      height: auto;
      display: block;
    }

    .logo .overlay-text {
      position: absolute;
      top: 50%;
      left: 0;
      width: 100%;
      transform: translateY(-50%);
      font-size: 1.2em;
      font-weight: bold;
      text-align: center;
      animation: moveTextRight 5s linear infinite alternate;
      color: red;
      text-shadow: 0 0 10px red, 0 0 20px red;
    }

    @keyframes moveTextRight {
      0% { left: 0; }
      100% { left: 50%; transform: translate(-50%, -50%); }
    }

    h1 {
      margin: 20px 0;
      font-size: 2em;
      color: lime;
      text-shadow: 0 0 10px lime, 0 0 20px lime;
      animation: Tamaa 5s linear infinite alternate;
    }

    @keyframes tayo/by irfa {
      0% { transform: translateX(0); }
      100% { transform: translateX(50%); }
    }

    p {
      font-size: 1em;
      margin: 10px 0;
      background-color: rgba(0, 0, 0, 0.7);
      padding: 10px;
      border-radius: 5px;
      text-shadow: 0 0 10px red, 0 0 20px red;
      color: red;
    }

    .email {
      font-family: 'Courier New', monospace;
      font-size: 1.2em;
      color: #FFD700; /* Warna terang (emas) */
      text-shadow: 0 0 10px #FFD700, 0 0 20px #FFD700;
      overflow: hidden;
      white-space: nowrap;
      display: inline-block;
      animation: moveEmail 10s linear infinite;
    }

    @keyframes moveEmail {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    .buttons {
      margin-top: 20px;
    }

    .button {
      display: block;
      margin: 10px auto;
      padding: 10px 20px;
      background-color: green;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      text-align: center;
      cursor: pointer;
      text-decoration: none;
      width: 200px;
    }

    .button.secondary {
      background-color: blue;
    }

    .button.spotify {
      background-color: #1DB954;
    }

    .button.audio {
      background-color: orange;
    }

    .button:hover {
      opacity: 0.9;
    }

    audio {
      margin-top: 20px;
      display: none;
    }

    iframe {
      margin-top: 20px;
      border: none;
      display: none;
    }
  </style>
  <script>
    function toggleSpotify() {
      const iframe = document.getElementById('spotifyPlayer');
      iframe.style.display = iframe.style.display === 'none' ? 'block' : 'none';
    }

    function toggleAudio() {
      const audio = document.getElementById('audioPlayer');
      if (audio.paused) {
        audio.play();
      } else {
        audio.pause();
      }
    }

    // Matrix code animation
    window.onload = function() {
      const canvas = document.createElement('canvas');
      canvas.className = 'matrix-canvas';
      document.querySelector('.matrix').appendChild(canvas);
      const ctx = canvas.getContext('2d');
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;

      const matrixChars = '111222333444555666777888999';
      const fontSize = 20;
      const columns = canvas.width / fontSize;

      const drops = Array.from({ length: columns }).fill(1);

      function draw() {
        ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = '#0F0';
        ctx.font = `${fontSize}px monospace`;

        drops.forEach((y, i) => {
          const text = matrixChars[Math.floor(Math.random() * matrixChars.length)];
          ctx.fillText(text, i * fontSize, y * fontSize);

          if (y * fontSize > canvas.height && Math.random() > 0.975) {
            drops[i] = 0;
          }

          drops[i]++;
        });
      }

      setInterval(draw, 50);
    };
  </script>
</head>
<body>
  <div class="matrix"></div>

  <div class="container">
    <div class="logo">
      <img src="https://img100.pixhost.to/images/943/543834894_yilzishop.jpg" alt="Proyek-Baru-18-9293-B55">
      <div class="overlay-text">#-#-#</div>
    </div>
    <h1> 1tsM3T4maa ./Tamaa</h1>
    <p><strong> ! About Me ! </strong></p>
    <p>? Never expect security in cyberspace because in cyberspace security is just an illusion ?</p>
    <p>We are not enemies, but reminders that your digital world needs better protection. Do not ignore small gaps, because small ones can be the beginning of destruction. </p>
    <p> <span class="email"> Welcome To Website </span></p>

    <audio id="audioPlayer" controls>
      <source src="http://c.top4top.io/m_32305ffqo1.mp3" type="audio/mpeg">
      Your browser does not support audio elements.
    </audio>
    <div class="buttons">
      <button class="Button Audio" onclick="toggleAudio()">Play/Stop Audio </button>
      <a href="https://t.me/BotsxzBot" class="button">Contact Us</a>
      <a href="https://whatsapp.com/" class="button secondary">To WhatsApp</a>
      <button class="Button Google" onclick="toggleSpotify()">-----</button>
    </div>

    <iframe 
      id="Google" 
      src="https://www.google.com" 
      width="300" 
      height="380" 
      allow="encrypted-media">
    </iframe>
  </body>
</html>