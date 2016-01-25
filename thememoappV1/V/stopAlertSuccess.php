<?php
    $title = "Delete Alerts | Emerald";
    include("../inc/headerInc.php");

/*==========================================
    1. $numOfClasses - Receive form input from 
                                        processStopAlerts.php
        $class - Will hold each $_POST[Class$i] from 
                        dropdown
        $listOfIds - Holds all the ids for SQL upload
    2. for - Run through the number of classes grabbing each 
                checked item by checking if it is not empty
    3. $deleteCount - Counts the number of classes
                                     deleted
                                     
==========================================*/
//1
$numOfClasses = $_POST["numOfClasses"];
$class = "";
$listOfIds = array();

//2
for($i = 0; $i < $numOfClasses; $i++) {

    if(!empty($_POST['Class'.$i])) {
        $listOfIds[] = $_POST['Class'.$i];
    }
    
}
//3
$deleteCount = count($listOfIds);

/*==========================================
With list of Ids in the array, we will create a SQL 
statement to delete the contact from 
user_to_syllabus table
==========================================*/
/*==========================================
    1. $db - Connect to database
    2. $deleteSql - Full SQL statement to delete contact
        $deleteSqlAnnex - Extends statement w/ Ids
        $Equals - stmnts to be placed w/n SQL
    3. if -Checks whether BOTH email & phone # are both
                taken
    4. if - Checks if the phone number & not the email
                is filled out
    5. if - Checks if email is the only one filled out
                                     
==========================================*/
//1
$db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//2
$deleteSql = "DELETE FROM user_to_syllabus WHERE"; 
$deleteSqlAnnex = "";
$phoneTransfer = "";
$emailTransfer = "";
$idEquals = " id = "; 
$and = " AND ";
$or = " OR ";
$phoneEquals = " phone_number = ";
$emailEquals = " email = ";

//3 first if
if(($_POST['phoneTransfer'] != "Canada" && $_POST['phoneTransfer'] != "USA") && !empty($_POST['emailTransfer'])) {
    $phoneTransfer = $_POST['phoneTransfer'];
    $emailTransfer = $_POST['emailTransfer'];
    
    //Customized SQL
    for($i = 0; $i < count($listOfIds); $i ++) {
        $deleteSqlAnnex .= $idEquals.$listOfIds[$i].$and.$phoneEquals."'$phoneTransfer'".$and.$emailEquals."'$emailTransfer'";
        if(count($listOfIds) - $i > 1) {
            $deleteSqlAnnex .= $or;
        }
    }
    $deleteSql .= $deleteSqlAnnex;
}

//4 second if
if(($_POST['phoneTransfer'] != "Canada" && $_POST['phoneTransfer'] != "USA") && empty($_POST['emailTransfer'])) {
    $phoneTransfer = $_POST['phoneTransfer'];
    
    //Customized SQL
    for($i = 0; $i < count($listOfIds); $i ++) {
        $deleteSqlAnnex .= $idEquals.$listOfIds[$i].$and.$phoneEquals."'$phoneTransfer'";
        if(count($listOfIds) - $i > 1) {
            $deleteSqlAnnex .= $or;
        }
    }
    $deleteSql .= $deleteSqlAnnex;
}

//5 third if
if(($_POST['phoneTransfer'] == "Canada" || $_POST['phoneTransfer'] == "USA") && !empty($_POST['emailTransfer'])) {
    $emailTransfer = $_POST['emailTransfer'];
    
    //Customized SQL
    for($i = 0; $i < count($listOfIds); $i ++) {
        $deleteSqlAnnex .= $idEquals.$listOfIds[$i].$and.$emailEquals."'$emailTransfer'";
        if(count($listOfIds) - $i > 1) {
            $deleteSqlAnnex .= $or;
        }
    }
    $deleteSql .= $deleteSqlAnnex;
}

/*==========================================
Delete the records w/ the prepared $deleteSql
==========================================*/
/*==========================================
    1. try - connect to db & delete record
                                     
==========================================*/
$queryStr = $deleteSql;
//1

try {
            $query = $db->prepare($queryStr);
            $query->execute();
            $classes = $query->fetchAll();
    } catch (PDOException $e) {

    }

?>

    <div class="primary-content col" style="background-color: #EDEDED">
        <h3 style="text-align: center"> Delete Successful</h3>
        <p style="text-align: center"><?php echo $deleteCount; ?> class(es) deleted.</p>

    </div>
<script src="../js/anim.js" type="text/javascript"></script>
</body>