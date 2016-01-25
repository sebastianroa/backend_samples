<?php
/*==============================================================
								Time to redefine the code
1. You have some the $_POST for months, days and years, which wont be the case for you
	You need to rearrange your code and assign these variable numbers to it
==============================================================*/
$error= "";


$monthNumberArray = array();
require_once("../M/model.php");    
//================================================================================================================
//                                                                                  Arrays that will be updated onto the DB
//================================================================================================================
$upload = array();
$secondUpload = array(1 => "identification", 2 => "task", 3 => "day", 4 => "month", 5 => "year", 6 => "unixTimeStamp", 7 => "instructor", 8 => "university");
$monthUpload = array("1"=>"Jan", "2"=>"Feb", "3"=> "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sept", "10" => "Oct", "11" => "Nov", "12" => "Dec");
$slice = 0;
$array_key = 1;
//================================================================================================================
//                                                           Random # Generator;
//================================================================================================================
 $j = 1;
$totalAmountEntries = $_POST['totalEntries'];

$identificationCode = mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);

$listOfEntries=array();
//================================================================================================================
//                                                          Make sure the days are appropriate w/ selected month
//================================================================================================================
for($i = 1; $i <= $totalAmountEntries; $i++ ){
    foreach($monthUpload as $number=>$months){
        if($_POST['months'.$i] == $months) {
            $monthNumberArray[$i] = $number;
        }
}

}
//
for($i = 1; $i <= $totalAmountEntries; $i++ ){
foreach($monthNumberArray as $monthNumber) {
 
    if(checkdate($monthNumber, $_POST['days'.$i],  $_POST['years'.$i]) === false){
           header('Location: ../V/errorPage.php?error=5');
           exit();
        }  
}
}
/*======================================================
In uploadSyllabus.php, you have a form that has two two input fields
that submit to the same $_POST['instructor'] & $_POST['uniInitial'];
1. Declare global variables for the two form inputs
2. If statement - that deteremines which form was filled based on screen
        size
========================================================*/
//1
$universityInitial = "";
$instructorName = "";
//2 - checks form for normal screens
if(!empty($_POST['instructor1']) && !empty($_POST['uniInitials1'])){
    $universityInitial = $_POST['uniInitials1'];
    $instructorName = $_POST['instructor1'];
}
//2 - checks forms for mobile screens
if(!empty($_POST['instructor2']) && !empty($_POST['uniInitials2'])) {
    $universityInitial = $_POST['uniInitials2'];
    $instructorName = $_POST['instructor2'];
}

//================================================================================================================
//                                                          Check to see if there were any blank spaces
//================================================================================================================
for($i = 1; $i <= $totalAmountEntries; $i++ ){    
if(empty($_POST['uploadSyllabus'.$i]) ||empty($instructorName) || empty($universityInitial)){
        header('Location: ../V/errorPage.php?error=1');
        exit();
}
}
for($i = 1; $i <= $totalAmountEntries; $i++ ){    
if($_POST['days'.$i] == "DD" ||$_POST['months'.$i] == "MM" || $_POST['years'.$i] == "YY"){
        header('Location: ../V/errorPage.php?error=2');
        exit();
}
}
//================================================================================================================
//                                                                      Receive Input from uploadSyllabus.php
//================================================================================================================
for($i = 1; $i <= $totalAmountEntries; $i++ ){                            
                        $listOfEntries[] = array($identificationCode, $_POST['uploadSyllabus'.$i], $_POST['days'.$i], $_POST['months'.$i], $_POST['years'.$i], strtotime($_POST['days'.$i].$_POST['months'.$i].$_POST['years'.$i]), strtoupper($instructorName), strtoupper($universityInitial)); //This is to call Time Info
                    }
foreach($listOfEntries as $messages){
     foreach($messages as $entry){ 
         $upload[$j] = $entry; // maybe the index is inherently off
         $j += 1;
     }
}
//===============================================================================================================
//                                                           Pairing both Arrays & Uploading onto DB
//================================================================================================================
                    $db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    for($i = 0; $i <= count($upload) + 1; $i+=8) {
                        if(!empty($upload[$i])) {
                        if(array_key_exists($array_key, $upload)){
                            $slicedUpload = array_slice($upload, $slice, 8);
                            $uploadDB = array_combine($secondUpload, $slicedUpload);
                            extract($uploadDB);
                            try {
                                $queryStr = "INSERT INTO tasks(identification, task, day, month, years, unixTimeStamp, instructor, university) VALUES('$identification', '$task', '$day', '$month', '$year', '$unixTimeStamp', '$instructor', '$university')";
                                $db->query($queryStr);
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }
                           
                            $array_key += 8;
                            $slice += 8;
                            
                        }
                        }
                    }
// The following loop ends here.. Second upload starts....
                        try {
                            $queryStr = "INSERT INTO identification_tasks(task_identification, class_instructor, university_name) VALUES('$identificationCode', '$instructor', '$university')";
                            $db->query($queryStr);
                            header("Location: ../V/uploadSyllabusSuccess.php?idNum= '$identificationCode' ");
                        } catch(PDOException $e) {
                            echo $e->getMessage();
                        }
/*======================================================
    Variables to be used for comparison in DB upload
 1. $repeatedClassName - Saves the name of the class just submitted
                                                to be used to compare with a possible 
                                                entry with that name
2. $repeatedUniName - Saves name of university for comparison as well
3. $rows - saves the array being brought down from the DB and used to 
                see if there is more than one row of the same name
4. $emptyarray - placeholder to make upload work, no important value
========================================================*/
$repeatedClassName = "";
$repeatedUniName = "";

$rows = "";
$emptyArray = array();
/*======================================================
    Grabbing all entries that match the class name & university uploaded
 1. SELECT*FROM - Grabs all entries that match the criteria
 2. $rows - Holds all entries
========================================================*/
                $datab = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
                $datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                try {
                        $queryStr = "SELECT * FROM identification_tasks WHERE class_instructor = '$instructor' AND university_name = '$university'";
                        $query = $datab->prepare($queryStr);
                        $query->execute($emptyArray);
                        $rows = $query->fetchAll();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
/*=============================================
1. if(count) - This will tell us whether there is more than one 
            username already on the database.
2. else() - Means this is the first time the database 
                has encountered this name
=============================================*/

                if(count($rows) > 1){
                    $repeatedClassName = $rows[1]["class_instructor"];
                    $repeatedUniName = $rows[1]["university_name"];
                    try {
/*=============================================
1. $queryStr - Will delete an entry that has the name 
                        and ID
=============================================*/
                        $queryStr = "DELETE FROM identification_tasks WHERE class_instructor ='$repeatedClassName' AND                  university_name='$repeatedUniName' AND task_identification = '$identificationCode'";
                        $query = $datab->prepare($queryStr);
                        $query->execute($emptyArray);
                        header('Location: ../V/errorPage.php?error=12');
                        exit();
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                    
                } 
?>