<?php
    $title = "Search Results | Alert Warrior";

    require_once("../M/model.php");
    $searchDefense = new defenseSystem();

    $trap = $_POST["trampa1"];
    $searchDefense->honeyDefense();
    //searchSyllabus.php received input
   $proSearch =  strtoupper(strip_tags(trim($_POST['professorSearch'])));
   $claSearch =  strtoupper(strip_tags(trim($_POST['classSearch'])));

    $match = array(); 
    require_once("../inc/headerInc.php");

?>  

    <div class="primary-content col" style="background-color: #EDEDED">
            <h1 style = "text-align: center">Search Results</h1>
           <?php
                   
                    if(empty($proSearch) && empty($claSearch)){
                        echo "<p style='text-align: center'>You left every single text field empty. Go back and fill in at least one of the text fields</p>";
                        exit();
                    }
                    $db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");//Change this now
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    try {
                        $results =$db->prepare("SELECT task_identification, university_name, class_instructor FROM identification_tasks WHERE class_instructor LIKE ? AND class_instructor LIKE ?");
                        
                        $results->bindValue(1, "%" . $proSearch . "%");
                        $results->bindValue(2, "%" . $claSearch . "%");
                        
                        $results->execute();
                        $match = $results->fetchAll(PDO::FETCH_ASSOC);
                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }
                   ?> 
        
    <?php 

    if($match == FALSE) {
        echo "<p style='text-align: center'>Your search results did not match our records</p>";
	echo "<a href='createSyllabus.php'>Create your own alerts</a>";
        exit();
    } 
 

/*============================================================
    1. $sliced_class - holds the array $classes to be manipulated, the $start to
                                  know where to start & the number 5 so it knows how far to 
                                  cut, in this case, 8 items ahead of start
    2. foreach - The newly cut array will be walked through and echoed out as
                            class
==============================================================*/
$classes = $match;
    $sliced_class = array_slice($classes, 0, 8);

?>
   <?php foreach($sliced_class as $class) { ?>

    <a style="text-decoration: none; display: block" class='animsition-link' href="../V/displaySyllabus.php?display=<?php echo $class['task_identification'];  ?>"><?php echo $class['class_instructor']; echo ", ".$class['university_name'];?></a>
        <?php echo "</br>"; ?>

    <?php } ?>


            
    </div>
	<script src="../js/anim.js" type="text/javascript"></script>
</body>

    