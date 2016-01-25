<?php
$title = "Delete Alerts | Alert Warrior";
include("../inc/headerInc.php");

?>  
    <div class="primary-content col animsition" style="background-color: #EDEDED">
        <h2 style="text-align: center">Enter the category that has received alerts </h2>
        
        
        <form method="post" action="processStopAlerts.php">
            <label style="display: block">Phone Number</label>
            <!--Enter Phone #-->
            <input type="text" name = "phone_number">
            <label style="display: block">Provider (if phone # filled in)</label>
                    <!--American Providers-->
                    <select name="usCompanies" style="border: 1px black solid; border-radius: 1px; display: block; margin-bottom: 2px">
                        <option value="USA">USA</option>
                        <option value="@txt.att.net">AT&amp;T</option>
                        <option value="@tmomail.net">T-Mobile</option>
                        <option value="@vtext.com">Verizon</option>
                        <option value="@messaging.sprintpcs.com">Sprint</option>
                        <option value="@mymetropcs.com">Metro PCS</option>
                        <option value="@email.uscc.net">US Cellular</option>
                        <option value="@vmobl.com">Virgin Mobile</option>
                    </select>
                    <!--Canadian Providers-->
                    <select name="caCompanies" style="border: 1px black solid; border-radius: 1px; display: block">
                        <option value="Canada">Canada</option>
                        <option value="@txt.bellmobility.ca">Bell Canada</option>
                        <option value="@fido.ca">Fido</option>
                        <option value="@pcs.rogers.com">Rogers</option>
                        <option value="@vmobile.ca">Virgin Mobile</option>
                    </select>
             <p style="display: block">And/Or</p>
            <!--Enter Email-->
            <label style="display: block">Email</label>
            <input type="email" name = "email">
            <input type="submit" name ="stopAlertSubmit" Value="Go">
        </form>
        
        
    </div>
<script src="../js/anim.js" type="text/javascript"></script>
</body>