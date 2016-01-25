<?php
    $title = "Delete Alert | Alert Warrior";

/*========================================
    Forms variables from stopAlerts.php
========================================*/
    $phone = strip_tags(trim($_POST['phone_number']));
    $email = strip_tags(trim($_POST['email']));
    $usProvider = $_POST['usCompanies'];
    $caProvider = $_POST['caCompanies'];
    $emptyArray = array();
    $rows = array();

/*========================================
   Making sure all fields are filled appropriately
========================================*/
/*========================================
   1. if($phone & $email) - Security check to avoid 
                                              blank requests
    2. if($usProvider & $ca) - Check Provider not
                                                 blank
    3. if(= US & CA) - Prevent user from selecting TWO
                                  providers
    4. if(provider == ?) - Concatenate $phone w/
                                        provider
=========================================*/
//1
if(empty($phone) && empty($email)) {
    header('Location: ../V/errorPage.php?error=9');
    exit();
}

//2
if(!empty($phone)){
    if($usProvider == "USA" && $caProvider == "Canada"){
        header('Location: ../V/errorPage.php?error=8');
        exit();
    }
}

//3
if($usProvider != "USA" && $caProvider != "Canada"){
    header('Location: ../V/errorPage.php?error=10');
    exit();
}

//4
if($usProvider == "USA"){
    $phone .= $caProvider;
} elseif($caProvider == "Canada"){
    $phone .= $usProvider;
}

/*========================================
    1. $db - Open connection
=========================================*/
$db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
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
if(($phone != "USA" && $phone != "Canada") && !empty($email)){
    
            $queryStr = "SELECT * FROM user_to_syllabus WHERE phone_number ='$phone' AND email = '$email'";

} elseif(!empty($email)){
    
            $queryStr = "SELECT * FROM user_to_syllabus WHERE email ='$email'";

    
} else {
   
            $queryStr = "SELECT * FROM user_to_syllabus WHERE phone_number ='$phone'";

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
    
if($classes == NULL) {
    header('Location: errorPage.php?error=13');
}

?>
<?php
/*========================================
                                        VIEW
=========================================*/

$title = "Delete Alerts | Emerald";
include("../inc/headerInc.php");

?>  
    <div class="primary-content col" style="background-color: #EDEDED">
        <h2 style="text-align: center">Check each class from which you want to stop receiving alerts</h2>
            <div style = "padding: 2.5%; border 1px solid lightgray; background-color: white">
                <form method="post" action="stopAlertSuccess.php">
                <?php
                    for($i=0;$i < count($classes); $i++) {
                        echo "<div class='combo' style='border-bottom: 2px solid #3E474F'; margin-bottom: 3%>";
                        ?>
                            <input style ="display: inline" type='checkbox' name='Class<?php echo $i; ?>' value='<?php echo $classes[$i]['task_identification']; ?>'>
                    <?php      
                        echo "<p style='text-align: center'>";
                        echo $classes[$i]["class_instructor"]; 
                        echo "</div>";   
                    }
                    ?>
                    <select name="numOfClasses" style="display: none">
                                <option value='<?php echo count($classes); ?>'><?php echo count($classes); ?></option>
                    </select>
                    <!--Carries the phone &/or email to delete the username on stopAlertSuccess.php-->
                    <input style ="display: none" type='checkbox' name='phoneTransfer' value='<?php echo $phone; ?>'checked>
                    <input style ="display: none" type='checkbox' name='emailTransfer' value='<?php echo $email; ?>'checked>
                    <input type="submit" value="Delete" class=".combo" style="border: 1.5px solid black; background-color: white; border-radius: 10px; margin: 3% 1% 3% 25%">
                </form>
            </div>
    </div>
