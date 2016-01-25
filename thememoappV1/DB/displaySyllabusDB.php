<?php

/*=====================================================
			Received $_POST output
=======================================================*/

$contactPhoneNumber = $_POST['numberSubmit'];

$contactEmail = $_POST['emailSubmit'];

$americanProvider = $_POST["usCompanies"];

$canadianProvider = $_POST['caCompanies'];

$syllabusNum = $_POST['syllabusID'];



$phoneNumber = "";
$emailAddress = "";
$provider = "";
$days = ""; 
$contactNum = "";
/*=====================================================
			Delete parens & dashes from phone #
1. $dash, $parens - searched for items
2. str_split - breaks every digit into an array piece
3. for - search and destroys $dash, $parens
4. for - combines all accepted array pieces into one variable
=======================================================*/
//1
$dash = "-";
$parenRight = ")";
$parenLeft = "(";
//2
$str = str_split($contactPhoneNumber);
$countStr = count($str);
//3
for($i = 0; $i < $countStr; $i++) {
	$newPhoneNumber = "";
	if($str[$i] == $dash || $str[$i] == $parenRight || $str[$i] == $parenLeft) {
		$str[$i] = "";
	}
}
//4
for($v = 0; $v < count($str); $v++) {
	$newPhoneNumber .= $str[$v];
}
$contactPhoneNumber = $newPhoneNumber;

/*=====================================================
		Checks if email & phone # fields were left empty
1. Store phone # into $contactNum 
=======================================================*/	

    if(empty($contactPhoneNumber) && empty($contactEmail)) {
        header('Location: ../V/errorPage.php?error=9');
        exit();
    } else {    
	    //1
        if(!empty($contactPhoneNumber)) {
            $phoneNumber = $contactPhoneNumber;
            $contactNum = $contactPhoneNumber;
        } 
    }

/*=====================================================
		Checks if both fields are empty
1. Stores email into $emailAddress
=======================================================*/	

    if(empty($contactPhoneNumber) && empty($contactEmail)) {
        header('Location: ../V/errorPage.php?error=9');
        exit();
    } else {    
	    //1
        if(!empty($contactEmail)) {
            $emailAddress = $contactEmail;
        }
    }

/*=====================================================
		Checks if provider fields are empty
1. Stores email into $emailAddress
=======================================================*/
    if($americanProvider == "USA" && $canadianProvider == "Canada" && $contactEmail == NULL){
            header('Location: ../V/errorPage.php?error=8');
            exit();
    } elseif($americanProvider != "USA" && $canadianProvider != "Canada"){
            header("Location: ../V/errorPage.php?error=10");
            exit();
    } elseif($americanProvider != "USA"){
       $provider = $americanProvider; 
        $contactNum = $contactNum.$provider;
    } elseif($canadianProvider != "Canada"){
       $provider = $canadianProvider;
        $contactNum = $contactNum.$provider;
    }




/*=====================================================
		Stores all values in checked boxes
=======================================================*/
for($i = 1; $i < 8; $i++){
    if(!empty($_POST['daysNotified'.$i])) {
        $stringDay = $_POST['daysNotified'.$i];
        $stringDay= strval($stringDay) . " ";
        $days =  trim($days . " " . $stringDay);
        
    }
}




/*=====================================================
		Upload info into DB
=======================================================*/
$db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            try {
                                $queryStr = "INSERT INTO user_to_syllabus(id, phone_number, email, days) VALUES('$syllabusNum', '$contactNum', '$emailAddress', '$days')";
                                $db->query($queryStr);
                                        header('Location: ../V/displaySyllabusSuccess.php');
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }

?>