<?php
if(!isset($_COOKIE['area51'])){
    exit();
}

?>
<html>
    <body>
        <p>For the uploading of a database</p>
        <form method="post" action="../only_req_files/examples/presmtp.php">
            <input type="submit" name="click" value="Launch" style="color: lime; border-radius: 5px; border: 1px solid black; background-color: navy"> 
        </form>
        <p>For sending out mail</p>
        <form method="post" action="../only_req_files/examples/smtp.php">
            <input type="submit" name="click" value="Launch" style="color: tomato; border-radius: 5px; border: 1px solid black; background-color: navy">
        </form>
    </body>
</html>