<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 
$x ="";
$y ="";

/*============================================
			Filter Output & Check DB
1. Strip of any errors
2. Upload into DB to check for classes
============================================*/
//1
	$class = strtoupper(strip_tags(trim($_GET['x'])));
	$instructor = strtoupper(strip_tags(trim($_GET['y'])));

//2
        $db = new PDO("mysql:host=localhost; dbname=memo", "***", "***");//Try guessing my password
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         try {
            		$results =$db->prepare("SELECT task_identification, university_name, class_instructor FROM identification_tasks WHERE class_instructor LIKE ? AND class_instructor LIKE ?");
                        
                	$results->bindValue(1, "%" . $instructor . "%");
                	$results->bindValue(2, "%" . $class . "%");
                        
                        $results->execute();
                        $match = $results->fetchAll(PDO::FETCH_ASSOC);
                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }





/*============================================
			Grab new output
1. Slice it into a sizeable portion for frontend
2. Upload into DB to check for classes
============================================*/

$classes = $match;
    $sliced_class = array_slice($classes, 0, 8);

	
	$jsonArray = array();
	$jsonArray = $sliced_class;

	//Place elements in array under index name of "greet"
/*
	$jsonArray[0]['greet'] = $x;
	$jsonArray[1]['greet'] = $y;
*/
	echo json_encode($jsonArray);

?>