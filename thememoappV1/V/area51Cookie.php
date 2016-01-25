<?php

$expiry =time() + (60 * 60);
setcookie('area51', 'proceed', $expiry, '/', '', '', TRUE);

header('Location: ../V/emeraldSignal.php');
?>
