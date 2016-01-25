<?php

    $title = "Create Alerts | Alert Warrior";
    

    require_once("../inc/headerInc.php");
?>



    <div class="primary-content col" style="background-color: #EDEDED">
            <h2 style ="text-align: center"> Log/ Sign Up To Create a Alerts</h2>
               
        <!--Sign in Table-->
        <div class="createSyllabusBackDrop">
                <h3 style="text-align: center; margin-bottom: 5px">New? Sign Up!</h3>
                    <form method="post" action="../DB/contactInfoUpload.php" onsubmit="return validateSignUp();">
                        <label style="display: block"><p>New Email or Phone #</p></label>
                            <input type="text" name="signInUser" class="universitySearch mobileSearch" id="newContact">
                        <label style="display: block"><p>New Password</p></label>
                            <input type="password" name="signInPass" class="universitySearch mobileSearch" id="newPassword">
                        <label style="display: block"><p>Retype Password</p></label>
                            <input type="password" name="signInPassAgain" class="universitySearch mobileSearch" id="retypePassword">
                        
                            <input type="text" name="trampa1" id="trampaOne">
                            <input type="submit" name="bannerSubmit3" class="universityButton mobileButton" value="Sign Up">
                        
                    </form>
		<div class ="signUpErrors"></div>
        </div>
        <!--Log In table-->
        <div class="createSyllabusBackDrop2">
                <h3 style="text-align: center; margin-bottom: 5px">Log In</h3>
                    <form method="post" action="../DB/contactInfoUpload.php">
                        <label style="display: block"><p>Email or Phone #</p></label>
                            <input type="text" name="logInUser" class="universitySearch mobileSearch">
                        <label style="display: block"><p>Password</p></label>
                            <input type="password" name="logInPass" class="universitySearch mobileSearch">
                        
                        <input type="text" name="trampa1" id="trampaOne">
                        <input type="submit" name="bannerSubmit4" class="universityButton mobileButton" value="Log In">
                        
                    </form>
        </div>
    </div>
    

<?php
    require_once("../inc/footerInc.php");
?>