<?php
$expiry = time()-60*1;
setcookie('status', 'granted', $expiry, '/', '', '', TRUE);

header('Location: ../index.php');
?>