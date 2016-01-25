<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 
/*=================================================================
		Receive Sign In input from index.html, sanitize and upload into server
1. Received posted input
2. Sanitize
3. Upload onto server
=================================================================*/
//1

$email = trim(strip_tags($_POST['email']));
$pass = trim(strip_tags($_POST['pass']));
$rep = trim(strip_tags($_POST['rep']));
$teacher = trim(strip_tags($_POST['teacher']));
$id = trim(strip_tags($_POST['identification']));



//2 if anything empty
if(empty($email) || empty($pass) || empty($rep)) {
	exit();
	echo 'something is empty';
}
//2 if passwords do not match
if($pass != $rep) {
	exit();
	echo 'passwords didnt match';
}

//2 encrypt
$salt =  '2a';
$pass = crypt($pass, $salt);

//3
$db = new PDO("mysql:host=localhost; dbname=memo", "Roaring20s", "September22");//CHANGE CHANGE CHANGE
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//2
try {
     $queryStr = "INSERT INTO userinfo(identification, user, password, teacher) VALUES('$id', '$email', '$pass', '$teacher')";     
     $db->query($queryStr);   
} catch (PDOException $e) {
     echo $e->getMessage();
}
/*=====
Additions:
1. An email asking them to confirm a link proving the email account was real
*/
?>