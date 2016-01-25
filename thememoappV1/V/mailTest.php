<?php
$header = "";
$msg = "Hey there";

$receiver ="5408509937@txt.att.net";
	mail($receiver, $header, $msg);
	echo "Mail Sent!";
echo gethostname();
?>