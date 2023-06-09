<?php
    if (isset($_POST["TardisLogs"])) {
        $logFile = fopen("../logs.json", "a+");
        $year = $_POST["year"];
        $lat = $_POST["lat"];
        $lng = $_POST["lng"];
        $id = $_POST["id"];
        $initialJSON = fread($logFile, filesize("../logs.json"));
        $decodedJSON = json_decode($initialJSON);
        class theLog {
            public $latitude;
            public $longitude;
            public $fullYear;
            public $tardisId;
            public $nowtime;
            public $nowdate;
        }
        $decodedLog = new theLog();
        $decodedLog->latitude = $lat;
        $decodedLog->longitude = $lng;
        $decodedLog->fullYear = $year;
        $decodedLog->tardisId = $id;
        $decodedLog->nowtime = date("h:ia");
        $decodedLog->nowdate = date("d M Y");
        array_push($decodedJSON, $decodedLog);
        $encodedJSON = json_encode($decodedJSON);
        file_put_contents("../logs.json", "");
        fwrite($logFile, $encodedJSON);
        fclose($logFile);
    }
?>