<?php
    $dbConn = new mysqli("localhost", "id20861127_shyamakseth", "s1H2y3A4m5##", "id20861127_tardisdb");
    if ($dbConn->connect_error) {
        die("Something went wrong. Please try again.");
    }
    $uname = $password = $unameErr = $passErr = $unameBord = $passBord = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $uname = $_POST["uname"];
        $password = $_POST["password"];
        $ok = 1;
        
        $userTestStmt = $dbConn->prepare("SELECT * FROM users WHERE uname = ?");
        $userTestStmt->bind_param("s", $uname);
        $userTestStmt->execute();
        $userTestResult = $userTestStmt->get_result();
        $userTestArray = $userTestResult->fetch_assoc();
        
        if (empty($uname)) {
            $unameErr = "Please enter your username.";
            $unameBord = "4px solid red";
            $ok = 0;
        }
        if ($userTestResult->num_rows < 1) {
            $unameErr = "This username does not exist. Please enter the correct username.";
            $unameBord = "4px solid red";
            $ok = 0;
        } else {
            $hashedPassword = $userTestArray["password"];
            if (!password_verify($password, $hashedPassword)) {
                $passErr = "The password is incorrect. Please enter the correct password.";
                $passBord = "4px solid red";
                $ok = 0;
            }
        }
        if (empty($password)) {
            $passErr = "Please enter your password.";
            $passBord = "4px solid red";
            $ok = 0;
        }
        if ($ok == 1) {
            setcookie("TardisId", $userTestArray["id"], time() + (86400*60), "/");
            header("location: ../console/");
        }
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login to your TARDIS Account</title>
        <style>
             body {
                background: #bbb;
                margin: 0px;
                font-family: 'Courier New';
            }
            .outerContainer {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
            }
            .box-container {
                overflow: auto;
                max-height: 90%;
                width: 70%;
                margin: auto;
                box-shadow: 0px 0px 40px #000;
                animation-name: pulse;
                animation-iteration-count: infinite;
                animation-duration: 0.8s;
            }
            .box {
                background: #001675;
                width: 100%;
                min-height: 70%;
                text-align: center;
                color: white;
                box-sizing: border-box;
                padding: 10px;
            }
            input[type=text], input[type=password] {
                width: 80%;
                font-size: 1.3em;
                font-weight: bold;
                background: black;
                padding: 10px;
                outline: none;
                color: white;
                border: 4px solid #444;
                font-family: 'Courier New';
            }
            input[type=password] {margin-bottom: }
            input[type=text]:focus, input[type=password]:focus {
                border: 4px solid #888;
            }
            input[type=submit] {
                cursor: pointer;
                font-size: 1.4em;
                font-family: 'Courier New';
                font-weight: bold;
                background: #000;
                padding: 20px;
                display: block;
                margin: auto;
                border-radius: 50px;
                color: white;
                border: none;
                outline: none;
                transition: 0.2s;
            }
            input[type=submit]:hover {
                background: #555;
            }
            .submitForm p {color: red;}
            @keyframes changeBG {
                0% { background: #2400a8; }
                50% { background: #2a02bd; }
                100% { background: #2400a8; }
            }
            @keyframes pulse {
                0% {transform: scale(1, 1);}
                50% {transform: scale(1.01, 1.01); box-shadow: 0 0 70px;}
                100% {transform: scale(1, 1);}
            }
        </style>
    </head>
    <body>
        <div class="outerContainer">
            <div class="box-container">
                <div class="box">
                    <h1>Login To TARDIS</h1>
                    <p style="font-size: 1.3em;">Already have an account on TARDIS? Login to it now! All you need to enter is your username and password.</p>
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="submitForm">
                        <input type="text" name="uname" placeholder="Your Username:" autocomplete="off" border="<?php echo $unameBord; ?>" value="<?php echo $uname; ?>">
                        <p><?php echo $unameErr; ?></p>
                        <input type="password" name="password" placeholder="Your Password:" border="<?php echo $passBord; ?>" value="<?php echo $password; ?>">
                        <p><?php echo $passErr; ?></p><br>
                        <input type="submit" value="Login!" name="submit">
                        <p style="color: white;">Don't have an account? <a href="../register" style="color: darkorange;">Click here!</a></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        const bannerElmnt = document.getElementsByTagName("div");
        bannerElmnt[bannerElmnt.length - 1].remove();
        const bannerScript = document.getElementsByTagName("script");
        bannerScript[bannerScript.length - 2].remove();
        bannerScript[bannerScript.length - 1].remove();
    </script>
</html>