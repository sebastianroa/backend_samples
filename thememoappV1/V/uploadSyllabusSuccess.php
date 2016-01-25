<?php

    $title = "Upload Success | Alert Warrior";
    $match = array();
    $syllabusNum = "";

     if(!empty($_GET['idNum'])) {
	    $syllabusNum = $_GET['idNum']; 
     }
     

    require_once("../M/model.php");


    require_once("../inc/headerInc.php");
?> 
        <div class="primary-content col" style="background-color: #EDEDED">
            <div style="border-radius: 2px; border: 1px solid lightgray; background-color: white; margin: 5%; padding: 5%">
		    <div class="signUpError"></div>
                <p style = "text-align: center; padding-bottom: 5px; padding-top: 25px">You're upload was successful</p>
                <p>Add your contact info if you want to receive alerts for this class</p>
		<form method="post" action="../DB/displaySyllabusDB.php" onsubmit="return validateCreator();">
			<label class="combo">Phone # (omit dashes &amp; parentheses)</label>
			
				<input type="text"  name="numberSubmit" class="combo" id="phoneNum" style="border-radius: 5%">
                 		
                
                	<label class="combo">Email</label>
			
                		<input type="text" name="emailSubmit" class="combo" id= "emailAddr" style="border-radius: 5%">
			<p>Select your provider (Note: This service is free and will always be free)</p>
                    <!--Drop Down for American Providers-->
		<div class= "providerSyllabusSuccess">
                    <select name="usCompanies" id="amProvider" style="border: 1px black solid; border-radius: 5px" class="killMargin blockDiv">
                        <option value="USA">USA</option>
                        <option value="@txt.att.net">AT&amp;T</option>
                        <option value="@tmomail.net">T-Mobile</option>
                        <option value="@vtext.com">Verizon</option>
                        <option value="@messaging.sprintpcs.com">Sprint</option>
			 <option value="@cspire1.com">C Spire</option>
                        <option value="@mymetropcs.com">Metro PCS</option>
                        <option value="@email.uscc.net">US Cellular</option>
                        <option value="@vmobl.com">Virgin Mobile</option>
                    </select>
                 </div>
                    <!--Drop Down for Canadian Providers-->
		<div class= "providerSyllabusSuccess">
                    <select name="caCompanies"  id="caProvider" style="border: 1px black solid; border-radius: 5px" class = "killMargin blockDiv">
                        <option value="Canada">Canada</option>
                        <option value="@txt.bellmobility.ca">Bell Canada</option>
                        <option value="@fido.ca">Fido</option>
                        <option value="@pcs.rogers.com">Rogers</option>
                        <option value="@vmobile.ca">Virgin Mobile</option>
                    </select>
		</div>
		    <select name="syllabusID" style="display: none">
                        <option value=<?php echo $syllabusNum; ?>><?php echo $syllabusNum; ?></option>
                    </select>
		    <p>Check the number of days before you would like to be notified about a due date</p>
		    <div>
                    	<input type="checkbox" name="daysNotified1" value="1" checked> 1 |
                    	<input type="checkbox" name="daysNotified2" value="2"> 2 |
                    	<input type="checkbox" name="daysNotified3" value="3"> 3 |
                    	<input type="checkbox" name="daysNotified4" value="4"> 4 |
                    	<input type="checkbox" name="daysNotified5" value="5"> 5 |
                    	<input type="checkbox" name="daysNotified6" value="6"> 6 |
                    	<input type="checkbox" name="daysNotified7" value="7"> 7
		    </div>
                   <input type="submit" name="bannerSubmit2" class="universityButton" value="Alert Me" style="margin-top: 5%; margin-left: 5%; border: black solid 2px; border-radius: 2px">
		</form>
                <a href="../V/createSyllabus.php" style="display: inline-block; margin-top: 8px">Or create another syllabus</a>
		    
            </div>
        </div>
    </body>
</html>