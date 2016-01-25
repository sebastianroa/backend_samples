<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="../normalize.css" type="text/css">
	<link rel="stylesheet" href="../js/animsition/animsition.min.css">
        <link rel="stylesheet" href="../main.css" type="text/css">
        <meta name="viewport" content="width=device-width">
        <!-- the meta tag will allow mobile devices to obey @media request rather than zoom out -->
        <!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>-->
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="../js/animsition/jquery.animsition.min.js"></script>
        <script src="../inc/incscript.js" type="text/javascript" charset="utf-8"></script>
	<link rel="icon" type="image/png" href="../img/alertwarriorpic.png" />
    </head>
    <body>
	<div class="main-wrapper animsition">	
            
<!--HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER-->
            
		<header class="main-header">
			<h1 class="main-logo"><a href="../index.php" class="animsition-link">Alert Warrior</a></h1>
			<ul class="main-nav">
                            
				<li><a href="../V/searchSyllabus.php" class="animsition-link">Receive Alerts</a></li>
                            
				<li><a href="../V/checkClass.php" class="animsition-link">Create Alerts</a></li>
                                 <?php
/*echo "<li class='disappear'><a href='../V/createSyllabus.php'>Log In</a></li>";*/
                                    if(isset($_COOKIE['status'])) {
                                        echo "<li><a href='../V/destroyCookie.php' class='animsition-link'>Log Out</a></li>";
                                    } 
                                        
                                    
                                ?>
			</ul>
		</header>