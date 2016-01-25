<!DOCTYPE html>
<html>
    <head>
         <?php $title = "Receive Text Alerts For Class"; ?>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="normalize.css" type="text/css">
	<link rel="stylesheet" href="js/animsition/animsition.min.css">
        <link rel="stylesheet" href="main.css" type="text/css">
        <meta name="viewport" content="width=device-width">
        <!-- the meta tag will allow mobile devices to obey @media request rather than zoom out -->
        <!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>-->
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="js/animsition/jquery.animsition.min.js"></script>
        <script src="script.js" type="text/javascript" charset="utf-8"></script>
	<link rel="icon" type="image/png" href="img/alertwarriorpic.png" />
    </head>
    <body>
	<div class="main-wrapper animsition">	
<!--HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER-->

		<header class="main-header">
			<h1 class="main-logo"><a href="index.php" class="animsition-link">Alert Warrior</a></h1>
			<ul class="main-nav glow">
                            
				<li><a href="V/searchSyllabus.php" class="animsition-link">Receive Alerts</a></li>
                            
				<li><a href="V/checkClass.php" class = "animsition-link">Create Alerts</a></li>
                                 <?php
                                    
  /* echo "<li class='disappear'><a href='V/createSyllabus.php'>Log In</a></li>";*/
                                    if(isset($_COOKIE['status'])) {
                                       echo "<li><a href='V/destroyCookie.php' class = 'animsition-link'>Log Out</a></li>";
                                    }
                                ?>
			</ul>
		</header>

<!--BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER BANNER-->
		<div class="main-banner" style="background-color: #7F5095">
			<p style="font-weight: 100; color: white; font-size: 2em">School Just Got Easier!</p>
                        <p class = "p_mobile">Receive Text/Email Alerts For Assignments</p>
                        <p class = "p_mobile">Create Assignment Alerts For A Class</p>
                    <form method="post" action="V/searchSyllabus.php">
                        <input type="text" name="trampa1" id="trampaOne">
                        <input type="submit" name="bannerSubmit" class="searchButton" value="Search" style="display: none">
                    </form>
                    <div class="tools-welcome" data-tip="(No log in required) Click on Receive Alerts at the top of the page, and put in the name of your class and instructor"><p class = "p_style">Receive Text/Email Alerts For a Class</p></div>
                    <div class="tools-welcome" data-tip="Either click Create Alerts or Log In to sign up. You will be redirected to a page where you can fill out all the necessary information from your class (Creating an account required)"><p class = "p_style">Create Alerts For a Class</p></div>
		</div>
<!--PRIMARY PRIMARY PRIMARY PRIMARY PRIMARY PRIMARY PRIMARY PRIMARY-->

<footer class="main-footer">
			<p style="color: white;">&copy;2015 Alert Warrior</p>
                          
                                <a href="https://www.facebook.com/alertwarrior"><img class="footerPics" src="img/facebook-wrap.png"></a>
                            
                           
                                <a href="#"  style="text-decoration: none; color: white"><img class="footerPics" src="img/twitter-wrap.png" ></a>
                            
                                <div clas s="animsition">
    
                                <a href="V/FAQ.php" class = "animsition-link"style="text-decoration: none; color: white">FAQ</a>
                                    
                                </div>
    
                                <div class="animsition">
                                    
                                <a href="#"  class = "animsition-link" style="text-decoration: none; color: white">Advertise w/ Us</a>
                                
                                </div>
                                <div class = "animsition">
                                    
                                <a href="V/stopAlerts.php" class = "animsition-link" style="text-decoration: none; color: white">Stop Receiving Alerts</a>
                                
                                </div>
    
                                
		</footer>
                </div>	

	<script src="js/anim.js" type="text/javascript"></script>
</body>

</html>
   