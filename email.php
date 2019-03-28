<?php
$to = "nklvijay@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: test@ijrte.com" . "\r\n";

if(mail($to,$subject,$txt,$headers))
	echo "sent";
else
	echo "note sent";
?>