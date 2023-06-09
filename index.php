<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TARDIS - Travel Through Time And Space</title>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Source+Sans+Pro&display=swap" rel="stylesheet">
        <style>
            html {scroll-behavior: smooth;}
            * {box-sizing: border-box;}
            body {
                font-family: 'Open Sans';
                margin: 0px;
                line-height: 1.6;
            }
            .header {
                background: #000;
            }
            .header h1 {
                opacity: 0;
                animation-name: fadeIn;
                animation-duration: 0.3s;
                animation-delay: 0.1s;
                animation-fill-mode: forwards;
            }
            .nav {
                display: flex;
                justify-content: space-between;
                align-items: stretch;
            }
            .nav-cont {
                display: flex;
                align-items: center;
            }
            .nav-item {
                padding: 15px 25px;
                color: white;
                font-weight: bold;
                text-decoration: none;
                font-size: 1.2em;
                transition: 0.2s;
            }
            .nav-item:hover {text-decoration: underline; color: darkorange;}
            .header-cont {
                color: white;
                padding: 40px 15px;
                text-align: center;
                background: #080808;
            }
            .header-cont p {
                font-size: 1.2em;
                max-width: 60%;
                margin: auto;
                opacity: 0;
                animation-name: fadeIn;
                animation-duration: 0.3s;
                animation-delay: 0.4s;
                animation-fill-mode: forwards;
            }
            .pulsingBtn {
                border: 2px solid #fff;
                outline: none;
                cursor: pointer;
                background: transparent;
                font-size: 0.9em;
                letter-spacing: 1.5px;
                text-align: center;
                padding: 10px;
                color: white;
                font-family: 'Open Sans';
                font-weight: bold;
                animation: moveAndFade 0.5s 0.7s forwards, pulse 0.9s infinite;
                opacity: 0;
            }
            .section {
                padding: 20px 15px;
                text-align: center;
            }
            .s1 {
                background: #ddd;
            }
            .s2 {
                background: #111;
            }
            .cardsContainer {
                display: flex;
                width: 100%;
                justify-content: space-around;
                padding: 15px 0px;
            }
            .card {
                width: 30%;
                box-shadow: 0 0 20px;
                transition: 0.2s;
                background: #fff;
            }
            .card:hover {transform: scale(1.1, 1.1);}
            .cardHeading {
                background: #ffc95e;
                text-align: center;
                padding: 15px;
            }
            .cardContent {
                background: #fff;
                padding: 10px;
            }
            .imageAndText {
                display: flex;
                justify-content: space-around;
                align-items: center;
            }
            .imageAndText p {
                width: 45%;
                color: white;
                font-size: 1.4em;
            }
            .imageAndText img {
                width: 45%;
            }
            footer {
                padding: 15px;
                background: darkred;
                text-align: center;
            }
            @keyframes pulse {
                0% {background: transparent; border: 2px solid #fff; color: white;}
                50% {background: white; color: #000; transform: scale(1.3, 1.3);}
            }
            @keyframes fadeIn {
                0% {opacity: 0;}
                100% {opacity: 1;}
            }
            @keyframes moveAndFade {
                0% {opacity: 0; transform: translate(-15px, 0px);}
                100% {opacity: 1; transform: translate(0, 0);}
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="nav">
                <div class="logo">
                    <img src="tardisLogo.png" width=170>
                </div>
                <div class="nav-cont">
                    <a class="nav-item" href="#">Home</a>
                    <a class="nav-item" href="console">Console</a>
                    <a class="nav-item" href="login">Login</a>
                    <a class="nav-item" href="register">Register</a>
                </div>
            </div>
            <div class="header-cont">
                <h1 style="margin-bottom: 30px; color: darkorange;">Travel through space and time with TARDIS</h1>
                <p>TARDIS is one of the world's greatest scientific discoveries. It allows you to travel through space and time in a few clicks. You can control your destination, register, login, and do so much more right at your fingertips.</p><br><br>
                <button class="pulsingBtn" onclick="window.location.href='#cards'">LEARN MORE</button>
            </div>
        </div>
        <div class="section s1" id="cards">
            <h1 style="color: #0a0042;">What do we do?</h1>
            <div class="cardsContainer">
                <div class="card">
                    <div class="cardHeading">
                        <h2 style="margin: 0;">Time Travel</h2>
                    </div>
                    <div class="cardContent">
                        <p>The TARDIS is a machine that allows you to travel in time. All you need is an account, which is free of cost. Then you can operate the machine in the Console.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="cardHeading">
                        <h2 style="margin: 0;">Travel Logs</h2>
                    </div>
                    <div class="cardContent">
                        <p>All of your travels are automatically recorded, and can be seen at any time, if you ever wish to refer to them.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="cardHeading">
                        <h2 style="margin: 0;">Extremely Safe</h2>
                    </div>
                    <div class="cardContent">
                        <p>Your safety is our top priority. No matter what happens, you will face no harm. The TARDIS's emergency protocols can evacuate you to the present in just one press of a button. Literally.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="section s2">
            <h1 style="color: lime; text-shadow: 2px 2px 10px;">The Best Since 30 Years</h1><br>
            <div class="imageAndText">
                <p>Since 30 years, TARDIS has been the sole company to manufacture a working time machine. Yet, we have done everything we can to make it as efficient and user-friendly as possible. Fumbling with the controls, unsure of what to do, is now a thing of the past.</p>
                <img src="tech.jpg">
            </div>
        </div>
        <footer>
            <h2 style="color: lime; text-shadow: 2px 2px 10px;">TARDIS</h2>
            <a href="#" class="nav-item">Home</a>
            <a href="console" class="nav-item">Console</a>
            <a href="login" class="nav-item">Login</a>
            <a href="travel-history" class="nav-item">Travel History</a>
            <a href="register" class="nav-item">Register</a><br><br><hr>
            <p style="color: orange;">&copy; Copyright TARDIS 2023-<?php echo date("Y"); ?>. All rights reserved.</p>
        </footer>
    </body>
    <script>
        const bannerElmnt = document.getElementsByTagName("div");
        bannerElmnt[bannerElmnt.length - 1].remove();
        const bannerScript = document.getElementsByTagName("script");
        bannerScript[bannerScript.length - 2].remove();
        bannerScript[bannerScript.length - 1].remove();
    </script>
</html>