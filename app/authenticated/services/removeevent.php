<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: /authenticated/errorpages/401");
    exit;
}

$url = 'http://10.5.0.4:8000/api/v1/auth/event/removeevent';

$eventData = array('EventName' => $_GET["eventname"]);

$options = array('http' => array(
  'method'  => 'POST',
  'header' => 'Authorization: Bearer '. $_SESSION["token"],
  'content' => http_build_query($eventData)
));
$context  = stream_context_create($options);
$result = @file_get_contents($url, false, $context);


$result = json_decode($result, true);

header('location: authenticated/home/events');

?>