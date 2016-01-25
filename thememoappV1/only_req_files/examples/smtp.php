<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - SMTP test</title>
</head>
<body>
<?php
ini_set("max_execution_time", 0);
/*===============================
                Upload entries 
================================*/

$db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$mailPile = array();
try { //Will grab anything w/n 7 days based on the timestamp calculation
        $results =$db->prepare("SELECT * FROM mailinglist LIMIT 100");
        $results->execute();
        $mailPile = $results->fetchAll(PDO::FETCH_ASSOC);
     } catch(PDOException $e) {
        echo $e->getMessage(); //Delete this when done
    }


//$receiver = array();

/*===============================
                Mail System
================================*/

ini_set("SMTP", "dedrelay.secureserver.net");
$subject = "alert";

$header = ""; //Does anything


for($i = 0; $i < count($mailPile); $i++) {
    $msg = $mailPile[$i]["Message"];
    $receiver = $mailPile[$i]["Receiver"];
    set_time_limit(0);
    $msg = $mailPile[$i]["Message"];
    mail($receiver, $subject, $msg, $header, '-fmail.alertwarrior.com');

    flush();
}

if(count($mailPile) > 0) {
try {
        $queryStr = "DELETE FROM mailinglist LIMIT 100";
            
        $db->query($queryStr);
            
    } catch (PDOException $e) {
                    echo $e->getMessage(); //Delete this when done
    }
}

echo "Sent out and deleted no more than 100 messages";

/*
require '../PHPMailerAutoload.php';
$msg = "Hello I sent through";
$mail = new PHPMailer();

$mail->isSMTP();

$mail->SMTPDebug = 2;

$mail->Debugoutput = 'html';

$mail->Host = "dedrelay.secureserver.net";//check w/ only domain

$mail->SMTPSecure = 'tls';                            


    
$mail->Port = 25;

$mail->SMTPAuth = true;

$mail->Username = "alertwarrior";

$mail->Password = "Magnus1993!";

$mail->setFrom('admin@alertwarrior.com', 'alertwarrior');

$mail->addAddress("alvaro.roa@eagles.usm.edu", 'To Name'); 

$mail->Subject = 'Alert';


$mail->msgHTML($msg);


if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
*/
?>
</body>
</html>
