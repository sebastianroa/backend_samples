<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 
/*=======================================================
				Grab ajax query and check to see if 
				username and password matches 
				what it seen on the database
1. GET the query
2. Check for empty
3. Prepare password
4. DB - Select rows where user = and pass= and grab their teacher status

=======================================================*/
//1

$user = strip_tags(trim($_GET['user']));
$pass = strip_tags(trim($_GET['password']));
$fail = array(array("identification"=> "error"));
$emptyArray = array();
//2 
if(empty($user) || empty($pass)) {
	exit();
	echo "One of fields is empty";
}
   
 //3
$salt = "2a";
$pass = crypt($pass, $salt);
   
//4
$db = new PDO("mysql:host=localhost; dbname=memo", "Roaring20s", "September22");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//4a Select all elements that match password
try {
   $queryStr = "SELECT * FROM userinfo WHERE user = '$user' AND password = '$pass'";
   $query = $db->prepare($queryStr);
   $query->execute($emptyArray);
   $rows = $query->fetchAll();
} catch (PDOException $e) {
   echo $e->getMessage();
}
if(!empty($rows)) {
	echo json_encode($rows);
	exit();
} else {
	echo json_encode($fail);
	exit();
}


?>