<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 

/*==========================================================================
						Grab all the info affiliated with the class ID
1. Retrieve Identification number

2. Connect to DB and retrieve all info affiliated with class
	
==========================================================================*/
//$identification = "0803661633";
$identification = $_GET['id'];

//Connect to DB
$queryStr = "SELECT id, identification, task, day, month, years, instructor, university FROM tasks WHERE identification = '$identification'";

$db = new PDO("mysql:host=localhost; dbname=memo", "Roaring20s", "September22");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {
            $query = $db->prepare($queryStr);
            $query->execute();
            $classes = $query->fetchAll();
    } catch (PDOException $e) {
            echo $e->getMessage();
    }


echo json_encode($classes);


?>