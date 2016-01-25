<?php
    $title = "Search Alerts | Alert Warrior";
    
    require_once("../inc/headerInc.php");
?>



    <div class="primary-content col" style="background-color: #EDEDED">
        <div class="searchSyllabusBackDrop">
            <h1 style ="text-align: center">Search a Class</h1>
            <form method="post" action="../V/searchResults.php" onsubmit="return validate();">
                        <input type="text" name="professorSearch" class="universitySearch" id="professorField" placeholder="Instructor Last Name">
                        <input type="text" name="classSearch" class="universitySearch"  id ="classField" placeholder="Class Name ex. ENG 101">
                        
                        <input type="text" name="trampa1" id="trampaOne">
                        <input type="submit" name="bannerSubmit2" class="universityButton" value="Go">
            </form>

		<div class="error_message"></div>	
		
        </div>
    </div>

<?php

 
    require_once("../inc/footerInc.php");
?>