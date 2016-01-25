<?php

    $title = "Upload Alerts";

    require_once("../M/model.php");
    $uploadSyllabusDefense = new defenseSystem();
    $printEntries = new selectEntries();

    $uploadSyllabusDefense->honeyDefense();

    require_once("../inc/headerInc.php");
    $numOfTasks = "";
?>  

    <div class="primary-content col" style="background-color: #EDEDED">
      <div class ="uploadSyllabusBackDrop">
        <h3 style ="text-align: center">Welcome!</h3>
        <p style="text-align: center">Now lets create the alerts</p>
        <p style="text-align: center"><span class="bigify">1.</span>Select the number of tasks (assignments, tests etc) due for this semester</p>
 
            <?php
            $printEntries->entryView();
            
            ?>
        </div>

     <div class="uploadSyllabusBackDrop2">
        <form method="post" action="../DB/uploadSyllabusDB.php" style="background-color: white">
         <p style="text-align: center"><span class="bigify">2.</span>Fill in the task fields w/ their corresponding due dates</p>
        <?php

                    $monthsOfYear = array("Jan", "Feb", "Mar", "May", "Jun", "Jul", "Aug", "Sep", "Oct",  "Nov", "Dec");
                    $years = array("2015", "2016");
                    if(isset($_POST["uploadSyllabusSubmit"])){ 
                        $numOfTasks = $_POST["numberOfTasks"]; 
                        $j = 1;

                        while($j <= $numOfTasks){
                            echo "<input type='text' name='uploadSyllabus$j' class='uploadSyllabus expandWidth75' placeholder='Task $j'>";

                            echo "<select name='totalEntries' class='totalEntry expandWidth'>";
                            echo "<option value=$numOfTasks class='totalEntry'>$numOfTasks</option>";
                            echo "</select>";
                            
                            echo "<div class = 'blockDiv underline'>";
                            echo "<select name='days$j' class='uploadSyllabusSelect1 expandDropDown killMargin'>"; 
                            echo "<option>DD</option>";
                            for($i=1; $i<32; $i++){
                                echo"<option value=$i>$i</option>";
                            }
                            echo "</select>";

                            echo "<select name='months$j' class='uploadSyllabusSelect1 expandDropDown killMargin'>";
                            echo "<option>MM</option>";
                            foreach($monthsOfYear as $month){
                                echo "<option value=$month>$month</option>";
                            }
                            echo "</select>";

                            echo "<select name='years$j' class='uploadSyllabusSelectY expandDropDown killMargin'>";
                            echo "<option>YY</option>";
                            foreach($years as $year){
                                echo "<option value=$year>$year</option>";
                            }
                            echo "</select>";
                            echo "</div>";
                            $j += 1;
                        }
                    }
                            
            ?>
                <p style="text-align: center"><span class="bigify">3.</span>Enter course name, instructor name and university initials</p>
                <span class="tool" data-tip="Enter info as instructor last name, class initial: Example: Smith ENG 300" tab-index="1">
                    <input type=text name="instructor1" class= "uploadSyllabus"  id = "uploadInstructorSyllabus" placeholder="Instructor & Class">
                </span>
                <span class="tool" data-tip="Enter the full name of the university" tab-index="2">
                    <input type=text name="uniInitials1" class= "uploadSyllabus"  id = "uploadUniSyllabus" placeholder="University Name">
                </span>
            <!--The 2 bottom text fields are for smaller screens but fulfill the purpose of the two upper text fields of submitting class & instructor-->
            <div class = "showMobile">
                    <p style="display: block; margin: 1%" class="displaySyllabusMobile">Instructor Last  Name and Class Name Ex. Smith ENG 300</p>
                    <input type=text name="instructor2" class= "displaySyllabusMobile combo">
                    <p style="display: block; margin: 1%" class="displaySyllabusMobile">Full name of university</p>
                    <input type=text name="uniInitials2" class= "displaySyllabusMobile combo">
            </div>
                    <input type="submit" name="uploadSyllabusSubmit1" value="Submit" class="uploadSyllabusSubmit expandWidth75 blockDiv  killMargin">

            </form>

        </div>
<?php

    require_once("../inc/footerInc.php");
?>