<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 
		/*===========================================================================
								Retrieve GET content
								& upload into DB
		1. $_GET content from url
		2. Clean up phone number
		3. Retrieve relevant information for JSON call back
		===========================================================================*/
//1
$rows = "";
$phoneNumber = "";
$email = "";
if(!empty($_GET['phoneNum'])) {
	$phoneNumber = strip_tags(trim($_GET['phoneNum']));
} 

if(!empty($_GET['email'])) {
	$email = strip_tags(trim($_GET['email']));
} 
//2
$numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

$numberArray = str_split($phoneNumber);
// Create a loop that grab each element of phone num and puts it into another loop that checks for the valid numbers
$phoneNumber = "";
for($i = 0; $i < count($numberArray); $i++) {
	for($j = 0; $j < count($numbers); $j++) {
		if($numberArray[$i] == $numbers[$j]) {
			$phoneNumber .= $numberArray[$i];
		}
	}
}



//3

$db = new PDO("mysql:host=localhost; dbname=memo", "Roaring20s", "September22");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*========================================
   Grab the contact information from the DB
========================================*/
/*========================================
    1. if, elseif, else - decides whether $phone &/or
                                  $email were submitted to modify 
                                  $db query
    2. $query - Will select all classes that have the 
                        phone # or emailed listed to it
=========================================*/
if(($phoneNumber) && !empty($email)){
    
            $queryStr = "SELECT * FROM user_to_syllabus WHERE phone_number ='$phoneNumber' AND email = '$email'";

} elseif(!empty($email)){
    
            $queryStr = "SELECT * FROM user_to_syllabus WHERE email ='$email'";

    
} else {
   
            $queryStr = "SELECT * FROM user_to_syllabus WHERE phone_number ='$phoneNumber'";

}

try {
            $query = $db->prepare($queryStr);
            $query->execute();
            $rows = $query->fetchAll();
    } catch (PDOException $e) {
            echo $e->getMessage();
    }

/*========================================
   With class ID held, grab all classes from 
                        DB for deletion
			
			NOTE:
			This part only grabs the identifications
			Its the next DB upload that grabs the
			name of the classes
========================================*/
/*========================================
1. $idSql -Base SQL statement subject to change
    $idSqlAnnex - Addon statement
    $phoneNum - Number extracted from DB
    $emailAddr - Email extracted from DB
    $studentClasses - array holding all classes
                                    student is signed up for
2. for- Loop through all the row elements
3. if - Stores all classes in $studentClasses array
4. for - attach class id to $idSql for DB upload
                        $or, $idEquals will be used to form 
                        final statement
        
=========================================*/
//1
$idSql = "SELECT task_identification, class_instructor FROM identification_tasks WHERE";
$idSqlAnnex ="";
$classId = "";
$phoneNum = "";
$emailAddr = "";
$studentClasses = array();
$classes = "";

//2
for($i=0; $i < count($rows); $i++) {
    //3
    if(!empty($rows[$i]["id"])) {
        $studentClasses[] = $rows[$i]["id"];
    }
}

//4
$or = " OR ";
$idEquals = " task_identification = ";
for($i = 0; $i < count($studentClasses); $i++) {
    $idSql .= $idEquals.$studentClasses[$i];
    if(count($studentClasses) - $i > 1){
        $idSql .= $or;
    }
}

/*========================================
Pull classes person has enrolled from database
                            to delete
=========================================*/
/*========================================
1. try - Grab all the classes that have matching id's
2. if - If an unrecognized contact is submitted,
            it will be caught & redirected 
                    to errorPage.php
=========================================*/
//1
$queryStr = $idSql;
try {
            $query = $db->prepare($queryStr);
            $query->execute();
            $classes = $query->fetchAll();
    } catch (PDOException $e) {
            echo $e->getMessage();
    }


echo json_encode($classes);


?>