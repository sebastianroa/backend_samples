<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 
/*=====================================================
			Received $_GET output
=======================================================*/

$contactPhoneNumber = $_GET['phoneNum'];

$contactEmail = $_GET['email'];

$syllabusNum = $_GET['syllabusID'];

$listOfDays = $_GET['days'];










/*=====================================================
			Delete parens & dashes from phone #
1. for - Destroys everything in the phone number except #s
2. Splits the number of days into spaces for legibility
=======================================================*/



//1
$numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

$numberArray = str_split($contactPhoneNumber);
// Create a loop that grab each element of phone num and puts it into another loop that checks for the valid numbers
$contactPhoneNumber = "";
for($i = 0; $i < count($numberArray); $i++) {
	for($j = 0; $j < count($numbers); $j++) {
		if($numberArray[$i] == $numbers[$j]) {
			$contactPhoneNumber .= $numberArray[$i];
		}
	}
}

//2
$number = str_split($listOfDays);
$count = count($number);
$listOfDays = "";
for($i = 0; $i < $count; $i++) {
	if($count - $i != 1) {
		$number[$i] .= " ";
	}
	$listOfDays .= $number[$i];
}


/*=====================================================
		Upload info into DB
=======================================================*/
$db = new PDO("mysql:host=localhost; dbname=memo", "Roaring20s", "September22");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            try {
                                $queryStr = "INSERT INTO user_to_syllabus(id, phone_number, email, days) VALUES('$syllabusNum', '$contactPhoneNumber', '$contactEmail', '$listOfDays')";
                                $db->query($queryStr);
				 echo "Upload was a success";
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }


?>