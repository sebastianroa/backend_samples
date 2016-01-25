<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 
/*======================================================
		Retrieve all posted information from editAlerts02.html
1. Arrays that will hold the multiple date and tasks that will be sent

2. Total will have the total amount per category that will be useful
		for looping
3. For loop will record all the values into the arrays

4. instructor uni and identification will be recorded once and 
		placed inside the database

5. A for loop that will record a variable from looped array

5. Update the info in the database
	a. Loop will grab the values from the array and store into var
		for DB upload
======================================================*/
//1

$tasks = array();
$days = array();
$months = array();
$years = array();
$ids = array();

//2
$total = $_POST['total'];

//3
for($i = 0; $i < $total; $i++  ) {
	$tasks[$i] = $_POST['task'.$i];
	$days[$i] = $_POST['day'.$i]; 
	$months[$i] = $_POST['month'.$i]; 
	$years[$i] = $_POST['year'.$i]; 
	$ids[$i] = $_POST['id'.$i]; 
}

//4
$instructor = $_POST['instructor'];
$uni = $_POST['uni'];
$identification = $_POST['identification'];
$unixTimeStamp = "";


//5
 $db = new PDO("mysql:host=localhost; dbname=memo", "Roaring20s", "September22");
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

for($i = 0; $i < $total; $i++) {
	//5a
	$stringTime = $days[$i]. ' ' . $months[$i] . ' ' . $years[$i];
	$unixTimeStamp = strtotime($stringTime);
	$unixTimeStamp = intval($unixTimeStamp);
	$task = $tasks[$i];
	$day = $days[$i];
	$month = $months[$i];
	$year = $years[$i];
	$id = $ids[$i];
	
                            try {
                                $queryStr = "UPDATE tasks SET identification = '$identification', task='$task', day='$day', month='$month', years='$year', unixTimeStamp='$unixTimeStamp', instructor='$instructor', university='$uni' WHERE id ='$id'";
                                $db->query($queryStr);
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }
}

echo "Upload should work";










?>