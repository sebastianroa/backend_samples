<?php

    $title = "Upload Alerts";
    $match = array();
 //Will validate whether id in HTTP is a full number w/o letters
    $emptyId = "";

    require_once("../M/model.php");

    require_once("../inc/headerInc.php");
?> 

    <div class="primary-content col animsition" style="background-color: #EDEDED">
        <?php
             $emptyId = intval($_GET['display']);
              if(empty($emptyId)){
                header('Location: ../V/searchSyllabus.php');
            } 
            $identification = $_GET['display'];

            $identification = (string) $identification;


                    $db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");//Change this as well
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    try {
                        $results =$db->prepare("SELECT task, day, month, years, instructor FROM tasks WHERE identification LIKE ?");
                        $results->bindParam(1, $identification);
                        $results->execute();
                        $match = $results->fetchAll(PDO::FETCH_ASSOC);
                        } catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                        

        ?>
            <div class = "displaySyllabusBackDrop">
                <h3 style="text-align: center; margin-bottom: 10px">List of Tasks</h3>
		 <p style="text-align: center">Scroll down to receive alerts</p>
                <?php 
                    if(count($match) == 0){
                        header('Location: ../V/errorPage.php?error=7');
                    }
                         foreach($match as $matches){ ?> 
                             <p class="displaySyllabusTab"><?php echo $matches["task"]; ?></p>
                             <p><?php echo $matches['day']. "/". $matches['month']. "/".$matches['years'] ?></p>
                             <p style = "color:#5fdf80">---------------------</p>
                               
                        <?php  } ?>
                        <a href="#" style="text-decoration: none">^ Return to Top</a>
            </div>
            <div class ="displaySyllabusBackDrop2">
                <form method="post" action="../DB/displaySyllabusDB.php"> <!--The form to submit contact info & the assignment id-->
                    <h3 style="text-align: center; margin: 1%">Receive Alerts</h3>
                    <p>Enter cell # for text and/or email for emails</p>
                     <!--PHONE NUMBER FORM-->
			<p>(omit dashes &amp; parentheses for phone #)</p>
                    <input type="tel" name="numberSubmit" class="universitySearch" placeholder="Phone Number" style="border: black solid 1px; border-radius: 2px; margin-left: 5%"/>
                    <!--EMAIL FORM-->
                    <input type="email" name="emailSubmit" class="universitySearch" placeholder="Email" style="border: black solid 1px; border-radius: 2px; margin-left: 5%">
                    <p>Select your provider (Note: This service is free and will always be free)</p>
                    <!--Drop Down for American Providers-->
		<div class= "providerSyllabusSuccess">
                    <select name="usCompanies" style="border: 1px black solid; border-radius: 5px" class="combo">
                        <option value="USA">USA</option>
                        <option value="@txt.att.net">AT&amp;T</option>
                        <option value="@tmomail.net">T-Mobile</option>
                        <option value="@vtext.com">Verizon</option>
			<option value="@cspire1.com">C Spire</option>
                        <option value="@messaging.sprintpcs.com">Sprint</option>
                        <option value="@mymetropcs.com">Metro PCS</option>
                        <option value="@email.uscc.net">US Cellular</option>
                        <option value="@vmobl.com">Virgin Mobile</option>
                    </select>
		</div>
                    <!--Drop Down for Canadian Providers-->
		<div class ="providerSyllabusSuccess">
                    <select name="caCompanies" style="border: 1px black solid; border-radius: 5px" class="combo">
                        <option value="Canada">Canada</option>
                        <option value="@txt.bellmobility.ca">Bell Canada</option>
                        <option value="@fido.ca">Fido</option>
                        <option value="@pcs.rogers.com">Rogers</option>
                        <option value="@vmobile.ca">Virgin Mobile</option>
                    </select>
		</div>
                    <!--Drop Down to Submit $identification to DB INVINCIBLE ##########################################-->
                    <select name="syllabusID" style="display: none">
                        <option value=<?php echo $identification; ?>><?php echo $identification; ?></option>
                    </select>

                    <!--Check boxes for desired days-->
                    <p>Check the number of days before you would like to be notified about a due date</p>
		<div class="providerSyllabusSuccess" style="padding-left: 5%">
                    <input type="checkbox" name="daysNotified1" value="1" checked> 1 |
                    <input type="checkbox" name="daysNotified2" value="2"> 2 |
                    <input type="checkbox" name="daysNotified3" value="3"> 3 |
                    <input type="checkbox" name="daysNotified4" value="4"> 4 |
                    <input type="checkbox" name="daysNotified5" value="5"> 5 |
                    <input type="checkbox" name="daysNotified6" value="6"> 6 |
                    <input type="checkbox" name="daysNotified7" value="7"> 7
		</div>
                    <input type="submit" name="bannerSubmit2" class="universityButton" value="Alert Me" style="margin-top: 5%; border: black solid 2px; border-radius: 2px; margin-left: 5%">
                </form>
        </div>
    </div>  
<script src="../js/anim.js" type="text/javascript"></script>
 </body>
</html>
        
        
        
        
        