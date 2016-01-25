<?php

    $title = "Upload Success | Alert Warrior";
    $match = array();

    require_once("../M/model.php");

    require_once("../inc/headerInc.php");
?> 
        <div class="primary-content col" style="background-color: #EDEDED">
            <div style="border-radius: 2px; border: 1px solid lightgray; background-color: white; border-top: 7px solid #00FF99; margin: 10% 25% 10% 25%">
                <p style = "text-align: center; padding-bottom: 15px; padding-top: 25px">Signing up for the alerts was successful</p>
                <a href="../V/searchSyllabus.php" class = "animsition-link" style="display: block; margin-left: 5%">Sign up for more alerts</a>
		    <a href="../V/uploadSyllabus.php" class= "animsition-link" style="display: block; margin-top: 8px; margin-left: 5%">Or create more alerts</a>
            </div>
        </div>
    </body>
<script src="../js/anim.js" type="text/javascript"></script>
</html>