<?php
    $title = "Error | Alert Warrior";
    

    $errorArray = array(1 => "You have not filled in either the task, instructor/class or university initial text fields", 
                                     2 => "You have not filled in all the DD/MM/YY drop down boxes",
                                     3 => "Unfilled criteria or incorrect logging in information",
                                     4 => "Your password and the retype did not match",
                                     5 => "A selected date does not exists",
                                     6 => "Error Id does not exists, stop messing around with the HTTP",
                                     7 => "Invalid ID",
                                     8 => "Please pick a provider from your country",
                                     9 => "Please fill in either the phone number or email field or both",
                                     10=> "You have selected two providers, please select only one",
                                     11=> "The username is already taken, select another one",
                                     12=> "This class has already been made. Only one alert schedule can be made per class per university. *Receive Alerts*                                                         already has this class. Put in your contact information to get alerted",
                                     13=> "The contact information entered does not exist in our database. Please check the text fields again");

    $errorMessage = $_GET["error"];
    if($errorMessage > "13" || empty($errorMessage)){
        $errorMessage = "6";
    }

    require_once("../inc/headerInc.php");
?>

<div class="primary-content col" style="background-color: lightgray">
        <p style ="text-align: center">Error: <strong><?php echo $errorArray[$errorMessage];  ?></strong></p>
        <p style ="text-align: center">Please go back</p>
        
</div>

<?php

    require_once("../inc/footerInc.php");
?>
