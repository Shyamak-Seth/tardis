<?php
    /* Made by Shyamak Seth.
        TARDIS Pvt. Ltd.*/
    
    $dbConn = new mysqli("localhost", "id20861127_shyamakseth", "s1H2y3A4m5##", "id20861127_tardisdb");
    if ($dbConn->connect_error) {
        die("Something went wrong. Please try again.");
    }
    
    $fnameErr = $lnameErr = $unameErr = $passErr = $cnfPassErr = 
    $fname = $uname = $lname = $password = $cnfpassword = ""; // Declaring error variables
    
    $fnameBord = $lnameBord = $unameBord = $passBord = $cnfPassBord = ""; // Styling errors
    
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $uname = $_POST["uname"];
        $password = $_POST["password"];
        $cnfpassword = $_POST["cnfpassword"];
        $ok = 1; // Used for validation (Value is 1 if no errors)
        
        $userTestStmt = $dbConn->prepare("SELECT * FROM users WHERE uname = ?");
        $userTestStmt->bind_param("s", $uname);
        $userTestStmt->execute();
        $userTestResult = $userTestStmt->get_result();
        
        
        if (empty($fname)) {
            $fnameErr = "Please enter your first name.";
            $fnameBord = "4px solid red";
            $ok = 0;
        }
        if (empty($lname)) {
            $lnameErr = "Please enter your last name.";
            $lnameBord = "4px solid red";
            $ok = 0;
        }
        if (empty($uname)) {
            $unameErr = "Please create a username.";
            $unameBord = "4px solid red";
            $ok = 0;
        }
        if ($userTestResult->num_rows > 0) {
            $unameErr = "An account with this username already exists. Please choose a different username.";
            $unameBord = "4px solid red";
            $ok = 0;
        }
        if (strlen($uname) > 40) {
            $unameErr = "The username can't be more than 40 characters long.";
            $unameBord = "4px solid red";
            $ok = 0;
        }
        if (empty($password)) {
            $passErr = "Please create a password.";
            $passBord = "4px solid red";
            $ok = 0;
        }
        if (strlen($password) < 8) {
            $passErr = "The password should be at least 8 characters long.";
            $passBord = "4px solid red";
            $ok = 0;
        }
        if (empty($cnfpassword)) {
            $cnfPassErr = "Please re-enter the password";
            $cnfPassBord = "4px solid red";
            $ok = 0;
        }
        if ($password != $cnfpassword) {
            $cnfPassErr = "The passwords do not match. Please try again.";
            $cnfPassBord = "4px solid red";
            $ok = 0;
        }
        if ($ok == 1) { // No errors, initiate registration
            $finalPassword = password_hash($password, PASSWORD_DEFAULT);
            $sqlQuery = $dbConn->prepare("INSERT INTO users (fname, lname, uname, password) VALUES (?, ?, ?, ?)");
            $sqlQuery->bind_param("ssss", $fname, $lname, $uname, $finalPassword);
            $sqlQuery->execute();
            $idToStore = $dbConn->insert_id;
            setcookie("TardisId", $idToStore, time() + (86400 * 60), "/");
            header("location: ../console/");
        }
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, intiail-scale=1.0">
        <title>TARDIS Console - Register</title>
        <style>
            body {
                background: #bbb;
                margin: 0px;
                font-family: 'Courier New';
                transition: 0.8s;
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
                background: #222;
            }
            .submitForm p {color: red;}
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
                    <h1 style="margin-bottom: 20px;">REGISTER ON TARDIS CONSOLE</h1>
                    <p style="font-size: 1.2em;">Hey, user! Let's get started with the TARDIS Console! First, enter the following details to create an account.</p>
                    <form class="submitForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <input name="fname" type="text" placeholder="Your First Name:" autocomplete="off" style="border: <?php echo $fnameBord; ?>" value="<?php echo $fname; ?>">
                        <p><?php echo $fnameErr; ?></p>
                        <input name="lname" type="text" placeholder="Your Last Name:" autocomplete="off" style="border: <?php echo $lnameBord; ?>" value="<?php echo $lname; ?>">
                        <p><?php echo $lnameErr; ?></p>
                        <input name="uname" type="text" placeholder="Create a Username:" autocomplete="off" style="border: <?php echo $unameBord; ?>" value="<?php echo $uname; ?>">
                        <p><?php echo $unameErr; ?></p>
                        <input name="password" type="password" placeholder="Create a Password:" style="border: <?php echo $passBord; ?>" value="<?php echo $password; ?>">
                        <p><?php echo $passErr; ?></p>
                        <input name="cnfpassword" type="password" placeholder="Confirm Password:" style="border: <?php echo $cnfPassBord; ?>" value="<?php echo $cnfpassword; ?>">
                        <p><?php echo $cnfPassErr; ?></p>
                        <input type="submit" name="submit" value="Register!">
                        <p style="color: white">Already have an account? <a href="../login/" style="color: darkorange;">Click here!</a></p>
                    </form>
                </div>
            </div>
        </div>
        <script>
            
        </script>
    </body>
</html>
