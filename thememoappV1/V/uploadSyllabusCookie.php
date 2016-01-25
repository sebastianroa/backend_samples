<?php
$expiry =time() + (86400 * 30);
setcookie('status', 'granted', $expiry, '/', '', '', TRUE);

header('Location: ../V/checkClass.php');
?>