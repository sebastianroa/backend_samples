<?php

$title = "Check for your class";

require_once("../inc/headerInc.php");

?>
	<!--HTML-->
	    <div class="primary-content col animsition" style="background-color: #EDEDED; padding: 5%">
		 <div class ="checkClassDiv">
		    <p>Chances are someone has already created the alerts for your class.</p>
		   <p>You can receive alerts from someone else in the same class as you OR you can create your own alerts :-) </p>
			 
		    <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
			    
		    	<label id="labelName">Instructor Last Name</label>
			    
		    		<input type ="text" name="lastName" id="checkName">
			    
		    	<label id="labelClass">Name of Class (Ex. Smith ENG 300)</label>
			    
		    		<input type="text" name="className" id="checkClass">
			 <input type="submit" name="submitButton" value="check" class="universityButton checkClassButton" style="margin: 2.5% 0 2.5% 2.5%">
		    </form>
			 <div style="margin-bottom: 5%">
				 <a href="uploadSyllabus.php" class="animsition-link">I would rather create my own alerts</a>
			</div>
			 <!--The following will output the search results-->
			 <?php
/*==========================================
Using Same Page, I will DB results & see if there are any
				class matches
1. $lastName && $className - Hold input info
2. Open connection to database
3. if(isset) - checks to see if submit was clicked on
4. Grab matching records from DB
5. Check to make sure that there were zero search 
	results found
==========================================*/
				//1
				$lastName = "";
				$className = "";
				$match = array();
				//2
				$db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//3
				if(isset($_POST["submitButton"])) {
					$lastName = strtoupper(strip_tags(trim($_POST["lastName"])));
					$className = strtoupper(strip_tags(trim($_POST["className"])));
					echo "<h2>List of Classes</h2>";
					//4
					try {
                        			$results =$db->prepare("SELECT task_identification, university_name, class_instructor FROM identification_tasks WHERE class_instructor LIKE ? AND class_instructor LIKE ?");
                        
                        			$results->bindValue(1, "%" . $lastName . "%");
                        			$results->bindValue(2, "%" . $className . "%");
                        
                        			$results->execute();
                        			$match = $results->fetchAll(PDO::FETCH_ASSOC);
                    			} catch(PDOException $e) {
                        				echo $e->getMessage();
                    			}
					//5
					if($match == FALSE) {
        					echo "<p style='text-align: center'>Your search results did not match our records</p>";
        					exit();
					}
				}
					 ?>
			 		<?php
/*============================================================
    1. $sliced_class - holds the array $classes to be manipulated, the $start to
                                  know where to start & the number 5 so it knows how far to 
                                  cut, in this case, 8 items ahead of start
    2. foreach - The newly cut array will be walked through and echoed out as
                            class
==============================================================*/
					$classes = array();
					$classes = $match;
    					$sliced_class = array_slice($classes, 0, 8);

			 		?>
   					<?php foreach($sliced_class as $class) { ?>

    						<a style="text-decoration: none; display: block" class = 'animsition-link' href="../V/displaySyllabus.php?display=<?php echo $class['task_identification'];  ?>"><?php echo $class['class_instructor']; echo ", ".$class['university_name'];?></a>
        <?php echo "</br>"; ?>

    <?php } ?>

		</div>
	    </div>
	<script src="../js/anim.js" type="text/javascript"></script>
</body>
