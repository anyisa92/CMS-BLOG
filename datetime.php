<?php 
date_default_timezone_set("America/New_York");
$currentTime= time();
$dateTime=strftime("%B-%m-%Y %H:%M:%S",$currentTime);
echo $dateTime;
?>