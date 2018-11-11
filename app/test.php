<?php
$eventName = $_GET["event"];

$ch = curl_init("http://192.168.1.113:4000/api/event/$eventName");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HEADER, 0);
          $data = curl_exec($ch);
          curl_close($ch);
          
          $resulteObj = json_decode($data, true);

if ($resulteObj == null) {
    echo "null";
} else if ($resulteObj == "null") {
    echo "'null 33'";
} else if ($resulteObj[0]["Match"] == null) {
    echo "match null";
}