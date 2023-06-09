<?php
    if (isset($_COOKIE["TardisId"])) {
        echo "<script>var myTardisId = " . $_COOKIE["TardisId"] . ";</script>";
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <title>TARDIS Console</title>
        <style>
            * {box-sizing: border-box;}
            body {
                margin: 0px;
                font-family: 'Courier New';
            }
            .map {
                height: 50%;
                background: #333;
            }
            .controls {
                height: 50%;
                background: #111;
                display: flex;
                flex-direction: column;
            }
            .controls-flex {
                display: flex;
                align-items: center;
                justify-content: space-around;
                width: 100%;
                height: 50%;
            }
            .control {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                color: white;
            }
            .button {
                border: none;
                outline: none;
                border-radius: 50px;
                padding: 20px;
                color: white;
                font-size: 1.2em;
                width: 100px;
                height: 100px;
                cursor: pointer;
                font-family: 'Courier New';
            }
            .button i {font-size: 2em;}
            
            .helpBtn {background: darkred; box-shadow: 5px 5px red;}
            .helpBtn:active {box-shadow: 1px 1px red; transform: translate(4px, 4px);}
            .startBtn {background: darkgreen; box-shadow: 5px 5px #00e007;}
            .startBtn:active {box-shadow: 1px 1px #00e007; transform: translate(4px, 4px);}
            .logBtn {background: navy; box-shadow: 5px 5px blue;}
            .logBtn:active {box-shadow: 1px 1px blue; transform: translate(4px, 4px);}
            .circuitBtn {background: #ffd900; box-shadow: 5px 5px #ffff64;}
            .circuitBtn:active {box-shadow: 1px 1px #ffff64; transform: translate(4px, 4px);}
            .rotorBtn {background: #008f85; box-shadow: 5px 5px #12ffef;}
            .rotorBtn:active {box-shadow: 1px 1px #12ffef; transform: translate(4px, 4px);}
            .appearBtn {background: #17c700; box-shadow: 5px 5px #68ff54;}
            .appearBtn:active {box-shadow: 1px 1px #68ff54; transform: translate(4px, 4px);}
            
            button:disabled {
                opacity: 0.1;
                cursor: not-allowed;
            }
            input[type=number] {
                border: 2px solid #fff;
                color: #fff;
                outline: none;
                padding: 10px 12px;
                font-family: 'Courier New';
                font-size: 1.4em;
                background: #000;
                width: 100%;
                text-align: center;
            }
            
            .map {display: flex; justify-content: center;}
            
            .map img {max-height: 50vh; max-width: 100vw; object-fit: contain;}
            
            .locator {
                display: none;
                width: 5px;
                height: 5px;
                background: red;
                border-radius: 50px;
                position: fixed
            }
            
            .status {
                background: navy;
                color: white;
                display: none;
                width: 100%;
            }
            
            @media only screen and (max-width: 800px) and (min-width: 650px) {
                .button { width: 80px; height: 80px; font-size: 1em; padding: 15px;}
                .button i {font-size: 1.8em;}
                #yearControl {width: 125%;}
            }
            @media only screen and (max-width: 650px) and (min-width: 550px) {
                .button {width: 70px; height: 70px; font-size: 0.9em; padding: 10px;}
                .button i {font-size: 1.6em;}
                #yearControl {width: 140%;}
            }
            @media only screen and (max-width: 550px) and (min-width: 400px) {
                .button {width: 60px; height: 60px; font-size: 0.8em; padding: 8px;}
                .button i {font-size: 1.4em;}
                #yearControl {width: 160%;}
                input[type=number] {font-size: 1em;}
            }
            @media only screen and (max-width: 400px) {
                .button {width: 60px; height: 60px; font-size: 0.8em; padding: 8px;}
                .button i {font-size: 1.4em;}
                #yearControl {width: 160%;}
                input[type=number] {font-size: 0.8em;}
            }
        </style>
    </head>
    <body>
        <div class="locator" id="locator"></div>
        <div class="main">
            <div class="map" id="map">
                <img src="world-map.png" onclick="selectLocation(event)">
            </div>
            <div class="controls" id="controls">
                <div class="controls-flex">
                    <div class="control">
                        <button class="button circuitBtn" disabled onclick="circuitToggle()"><i class="fas fa-dragon"></i></button>
                    </div>
                    <div class="control">
                        <button class="button rotorBtn" disabled onclick="rotorToggle()"><i class="fas fa-hourglass" id="rotor"></i></button>
                    </div>
                    <div class="control">
                        <button class="button appearBtn" disabled onclick="materializeToggle()"><i class="fas fa-bahai"></i></button>
                    </div>
                    <div class="control">
                        <a href="../travel-history" target="_blank"><button class="button logBtn" disabled><i class="fas fa-book"></i></button></a>
                    </div>
                </div>
                <div class="controls-flex">
                    <div class="control">
                        <button class="button helpBtn" disabled id="emergency" onclick="emergencyProt()"><i class="fas fa-exclamation-triangle"></i></button>
                    </div>
                    <div class="control" id="yearControl">
                        <input type="number" placeholder="Enter The Year:" id="year">
                        <div class="status" id="status">
                            <p id="latitude"></p>
                            <p id="longitude"></p>
                            <p id="theYear"></p>
                        </div>
                    </div>
                    <div class="control">
                        <button class="button startBtn" onclick="startJourney()" id="startBtn">START</button>
                        <button class="button startBtn" style="display: none;" onclick="window.location.reload()" id="stopBtn">GO BACK</button>
                    </div>
                    
                </div>
            </div>
        </div>
        <script>
            const allBtns = document.getElementsByTagName("button");
            for (let i = 0; i < allBtns.length; i++) {
                if (allBtns[i].id != "emergency") {
                    allBtns[i].addEventListener("click", function() {
                        var audio = new Audio("button-sound.mp3");
                        audio.play();
                    });
                }
            }
            var locationSelected = false;
            var locationSubmitted = false;
            const latlng = {lat: 0, lng: 0};
            var circuit, rotor, materialize = false;
            function selectLocation(e) {
                if (!locationSubmitted) {
                    const rect = e.target.getBoundingClientRect();
                    let longitude = e.clientX - rect.left;
                    let latitude = e.clientY - rect.top;
                    let realLongitude = (longitude / (rect.width/360)) - 180;
                    let realLatitude = -((latitude / (rect.height / 179)) - 89.5);
                    console.log(realLatitude + " " + realLongitude);
                    document.getElementById("locator").style.display = "block";
                    document.getElementById("locator").style.top = e.clientY + "px";
                    document.getElementById("locator").style.left = e.clientX + "px";
                    locationSelected = true;
                    latlng.lat = realLatitude.toFixed(4);
                    latlng.lng = realLongitude.toFixed(4);   
                }
            }
            
            function startJourney() {
                let yearVal = document.getElementById('year').value;
                if (yearVal < 1500 || yearVal > 2300) {
                    setTimeout(function() {
                        alert("The year can't be before 1500 or after 2300.");
                    }, 500);
                } else if (locationSelected == false) {
                    setTimeout(function() {
                        alert("Please select a location from the map.");
                    }, 500);
                } else {
                    const allBtns = document.getElementsByTagName("button");
                    for (let i = 0; i < allBtns.length; i++) {
                        allBtns[i].removeAttribute("disabled");
                    }
                    document.getElementById("year").style.display = "none";
                    document.getElementById("status").style.display = "block";
                    document.getElementById("latitude").innerHTML = "Latitude: " + latlng.lat;
                    document.getElementById("longitude").innerHTML = "Longitude: " + latlng.lng;
                    document.getElementById("theYear").innerHTML = "Year: " + yearVal;
                    document.getElementById("startBtn").style.display = "none";
                    document.getElementById("stopBtn").style.display = "block";
                    locationSubmitted = true;
                    const xhttp = new XMLHttpRequest();
                    let logParams = "year=" + yearVal + "&lat=" + latlng.lat + "&lng=" + latlng.lng + "&TardisLogs=true&id=" + myTardisId;
                    xhttp.open("POST", "createLog.php", true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.onload = function() {
                    }
                    xhttp.send(logParams);
                }
            }
            async function circuitToggle() {
                if (!circuit) {
                    document.getElementById("controls").style.background = "#ff3729";
                    document.getElementById("map").style.background = "#ff8178";
                    setTimeout(function() {
                        alert("The Chameleon Circuit is now ACTIVATED. The TARDIS can now be seen as a telephone box.");
                    }, 500);
                    circuit = true;
                } else {
                    document.getElementById("controls").style.background = "#111";
                    document.getElementById("map").style.background = "#333";
                    setTimeout(function() {
                        alert("The Chameleon Circuit is now DEACTIVATED. The TARDIS can now be seen by anyone.");
                    }, 500);
                    circuit = false;
                }
            }
            function rotorToggle() {
                if (!rotor) {
                    document.getElementById("rotor").classList.add("fa-spin");
                    setTimeout(function() {
                        alert("The time rotor is now ACTIVATED. If anything goes wrong, the rotor will stop spinning.");
                    }, 500);
                    rotor = true;
                } else {
                    document.getElementById("rotor").classList.remove("fa-spin");
                    setTimeout(function() {
                        alert("The time rotor is now DEACTIVATED.");
                    }, 500);
                    rotor = false;
                }
            }
            function materializeToggle() {
                if (!materialize) {
                    document.body.style.opacity = "0.5";
                    setTimeout(function() {
                        alert("The TARDIS has DEMATERIALIZED. The machine cannot be seen by anyone outside of it.");
                    }, 500);
                    materialize = true;
                } else {
                    document.body.style.opacity = "1";
                    setTimeout(function() {
                        alert("The TARDIS has MATERIALIZED. It is visible to the outside world.");
                    }, 500);
                    materialize = false;
                }
            }
            function emergencyProt() {
                var buzzerAudio = new Audio("buzzer.mp3");
                buzzerAudio.play();
                if (confirm("Are you sure you want to activate the EMERGENCY PROTOCOL?")) {
                    document.getElementById("theYear").innerHTML = "Year: " + new Date().getFullYear();
                    setTimeout(function() {
                        alert("You were evacuated, and have been transported to the present. You will now be redirected to the default TARDIS console.");
                        window.location.reload();
                    }, 1500);
                }
            }
            function goToJournal() {
                
            }
        </script>
    </body>
    
    <script>
        const bannerElmnt = document.getElementsByTagName("div");
        bannerElmnt[bannerElmnt.length - 1].remove();
        const bannerScript = document.getElementsByTagName("script");
        bannerScript[bannerScript.length - 2].remove();
        bannerScript[bannerScript.length - 1].remove();
    </script>
</html>
<?php
    } else {
        header("location: ../register/");
    }
?>