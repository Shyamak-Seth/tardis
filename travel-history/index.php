<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your travel history</title>
        <style>
            body {
                font-family: sans-serif;
                background: #ddd;
                text-align: center;
            }
            h2 {
                color: darkred;
            }
        </style>
    </head>
    <script>
        const bannerElmnt = document.getElementsByTagName("div");
        bannerElmnt[bannerElmnt.length - 1].remove();
        const bannerScript = document.getElementsByTagName("script");
        bannerScript[bannerScript.length - 2].remove();
        bannerScript[bannerScript.length - 1].remove();
    </script>
</html>
<?php
    if (isset($_COOKIE["TardisId"])) {
        $id = $_COOKIE["TardisId"];
        $logFile = fopen("../logs.json", "a+");
        $initialJSON = fread($logFile, filesize("../logs.json"));
        $decodedJSON = json_decode($initialJSON);
        $j = 0;
        foreach($decodedJSON as $obj) {
            $gotId = $obj->tardisId;
            if ($id == $gotId) {
                $j++;
                echo "<h2>Time Travel $j</h2>";
                echo "<p>You travelled to the year <b>" . $obj->fullYear . "</b>.</p>";
                echo "<p>The latitude of your destination was <b>" . $obj->latitude . "</b>.</p>";
                echo "<p>The longitude of your destination was <b>" . $obj->longitude . "</b>.</p>";
                echo "<p>You travelled at <b>" . $obj->nowtime . "</b> on <b>" . $obj->nowdate . "</b>.</p><br>";
            }
        }
    }
?>