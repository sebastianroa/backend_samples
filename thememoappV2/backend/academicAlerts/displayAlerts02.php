<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 
/*===================================================
			Upload id number into DB & show alerts
//1 
//2 Upload id into DB
===================================================*/
//1
	$identification = $_GET['id'];

        $identification = (string) $identification;
//2
         $db = new PDO("mysql:host=localhost; dbname=memo", "Roaring20s", "September22");//Change this as well
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          try {
                 $results =$db->prepare("SELECT task, day, month, years, instructor FROM tasks WHERE identification LIKE ?");
                 $results->bindParam(1, $identification);
                 $results->execute();
                 $match = $results->fetchAll(PDO::FETCH_ASSOC);
                } catch(PDOException $e) {
                   echo $e->getMessage();
                }

	echo json_encode($match);

?>