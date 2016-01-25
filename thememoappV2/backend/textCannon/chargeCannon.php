<?php 
echo "<p>Connection successful</p>";



echo "Launch your signal here";
echo "</br>";
echo "</br>";
$match  = array(); //DB info will b stored into here
$userMatch = array(); //DB user_to_syllabus
$identification = array();
$tasks = array(); //Holds name of tasks
$duedates = array(); // Holds the duedates
$instructor = array(); // Name of instructor and class
$message = array();

$mailingList = array(); //This will be the filtered users that will be emailed about a notification
$mailingInfo = array(); //Information to be sent to people

//Welcome, grab the info from the database, organize it, and mail it out
    //================================================================================================================
    //                                                                          Connect to the DB 
    //================================================================================================================




                    $db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        try { 
                        $results =$db->prepare("SELECT identification, instructor, task, day, month, years, 
                        CASE
                                    WHEN unixTimeStamp - UNIX_TIMESTAMP() < 86400 
                                    AND unixTimeStamp - UNIX_TIMESTAMP() > 0 
                                    THEN '1'
                                    WHEN  unixTimeStamp - UNIX_TIMESTAMP()  < 172800
                                    AND unixTimeStamp - UNIX_TIMESTAMP() > 86401
                                    THEN '2'
                                    WHEN  unixTimeStamp - UNIX_TIMESTAMP()  < 259200
                                    AND unixTimeStamp - UNIX_TIMESTAMP() > 172801
                                    THEN '3'
                                    WHEN  unixTimeStamp - UNIX_TIMESTAMP()  < 345600
                                    AND unixTimeStamp - UNIX_TIMESTAMP() > 259201
                                    THEN '4'
                                    WHEN  unixTimeStamp - UNIX_TIMESTAMP()  < 432000
                                    AND unixTimeStamp - UNIX_TIMESTAMP() > 345601
                                    THEN '5'
                                    WHEN  unixTimeStamp - UNIX_TIMESTAMP()  < 518400
                                    AND unixTimeStamp - UNIX_TIMESTAMP() > 432001
                                    THEN '6'
                                    WHEN  unixTimeStamp - UNIX_TIMESTAMP()  < 604800
                                    AND unixTimeStamp - UNIX_TIMESTAMP() > 518401
                                    THEN '7'
                                    END AS duedates 
                                    FROM tasks 
                                    WHERE unixTimeStamp - UNIX_TIMESTAMP() > 0 
                                    AND unixTimeStamp - UNIX_TIMESTAMP() < 604801"); 
                        $results->execute();
                        $match = $results->fetchAll(PDO::FETCH_ASSOC);
                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }

    //================================================================================================================
    //                                                               1. Grab all the assignment id's w/ upcoming due dates
    //                                                               2. Create the MYSQL statement that will filter & retrieve requested contacts
    //================================================================================================================
    $idNum=""; //Holds the identification # to be checked to make 
    $idarray = array(); //All the identifications that have a duedate in the next 7 days
    $listOfIds = "SELECT * FROM user_to_syllabus WHERE"; //MYSQL code w/ all IDs & OR keywords combined

    for($i = 0; $i < count($match); $i++){ // Will put id's into array making sure each is stored once
        if($idNum != $match[$i]["identification"]) { //if the next id in line is equal to the next, its a repeat so discard
                $idarray[] = $match[$i]["identification"];
        }
        $idNum = $match[$i]["identification"];
    }

    //We will form the MYSQL statement w/ ids and OR's
    for($i = 0; $i < count($idarray); $i++){
        $listOfIds .= ' id = ';
        $listOfIds .= $idarray[$i];
        if(count($idarray) - $i > 1){
            $listOfIds .= ' OR ';
        }
    }
    //================================================================================================================
    //                                                                          Connect to the DB 
    //================================================================================================================
                    $dbs = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
                    $dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //================================================================================================================
    //                                                                 Extract users subscribed to the syllabus
    //================================================================================================================
                    try { //Will grab all users subscribed to the retrieved syllabus
                        $results =$dbs->prepare($listOfIds);
                        $results->execute();
                        $userMatch = $results->fetchAll(PDO::FETCH_ASSOC);
                    } catch(PDOException $e){
                        echo $e->getMessage();
                    }

    //================================================================================================================
    //                                                          Grab all values retrieved from DB & stick them in arrays
    //================================================================================================================
$counter = 0;
            for($i = 0; $i <= count($match); $i++){
                if(!empty($match[$i]["duedates"])){ 
                    $identification[] = $match[$i]["identification"];
                    $tasks[] = $match[$i]["task"];
                    $duedates[] = $match[$i]["duedates"];
                    $instructor[] = $match[$i]['instructor'];
                    $counter += 1;
                }
            }
    //================================================================================================================
    //                                                                  1. Connect to DB to extract users wanting these assignment alerts
    //                                                                  2.Put retrieved info into correct arrays
    //================================================================================================================
 //THIS IS WHERE YOU WILL PUT A MESSAGE IN THE DB --> Upload the message 
$v = 0;
$num = 1;
while($v < $counter){
                $message[] = "Due in"." ".$duedates[$v]. " "."day(s): ".$tasks[$v]." "."in"." ".$instructor[$v]. " ". "Class ID=".$identification[$v];
    echo "</br>";
    echo "</br>";
    $v += 1;
    }

    /*================================================================================================================
                                                                Sort contacts w/ their due date messages
	1. $dash, $parenRight, $parenLeft - items to search & destroy in phone number
	
    ===============================================================================================================*/
//1
$dash = "-";
$parenRight = "(";
$parenLeft = ")";
$phoneNumber = "";
$str = "";
$countStr = "";


for($i = 0; $i < count($userMatch); $i++){
    
    for($j = 0; $j < count($message); $j++){ // I could be having the issues right here -> the method isn't catching the numbers
        
        if(strpos($message[$j], $userMatch[$i]["id"]) !== false && strpos($userMatch[$i]["days"], $duedates[$j]) !== false){
            
            if(!empty($userMatch[$i]["phone_number"])){
                $mailingList[] = $userMatch[$i]["phone_number"];
                $mailingInfo[] = $message[$j];
            }
            if(!empty($userMatch[$i]["email"])){
                $mailingList[] = $userMatch[$i]["email"];
                $mailingInfo[] = $message[$j];
            }
        }
    }
}
/*=====================================================
			Delete Class ID
1. $wordPieces - hold
    $newMsg - Holds new sentence w/o class ID
2. for - will go thru every single message in $mailingInfo
3. for - searches the exploded array for keyword class & deletes it
4. for - assembles the exploded array back into one sentence
5. $newMsg - perfected msg to be placed back into $mailingInfo
=======================================================*/
//1
$wordPieces = "";
$newMsg= "";

//2
for($i = 0; $i < count($mailingInfo); $i++) { 
	$combinedMsg = "";
	$wordPieces = explode(" ", $mailingInfo[$i]);
	
	//3
	for($j = 0; $j < count($wordPieces); $j++) {
		
		if($wordPieces[$j] == "Class") {
			$wordPieces[$j] = "";
			$wordPieces[$j+1] = "";
		}

	}
	//4
	for($v = 0; $v < count($wordPieces); $v++) {
		$combinedMsg .= $wordPieces[$v];
		$combinedMsg .= " ";
	}
	//5
	$newMsg = $combinedMsg;
	$mailingInfo[$i] = $newMsg;

}


/*=================================================
                Upload entries 
1. for - will run through all the messages giving them an $i index
2. Insert - the following information into the db table mailinglist
=================================================*/

ini_set("max_execution_time", 0);

for($i = 0; $i < count($mailingList); $i++) {
    
    try {
        $queryStr = "INSERT INTO mailinglist (Receiver, Message) VALUES('$mailingList[$i]', '$mailingInfo[$i]')";
            
        $db->query($queryStr);
            
    } catch (PDOException $e) {
                    echo $e->getMessage(); //Delete this when done
    }
    
}


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
?>