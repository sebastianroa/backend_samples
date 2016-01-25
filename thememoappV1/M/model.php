<?php

    class defenseSystem {
        
        public function honeyDefense()    {
            if(!empty($_POST["trampa1"])){
                exit();
            }
        }  
        
        public function inputDefense($input) {
            $input = trim($input);
            $input = strip_tags($input);
            return $input;
        }
}

    class contactInfo {
        public function uploadContactInfo($security) {
            
            if(!empty($_POST["signInUser"]) && !empty($_POST["signInPass"])){
                $trim1 = trim($_POST["signInUser"]);
                $strip1 = strip_tags($trim1);
                $filter1 = $strip1;
                $signUser = $filter1;
                $trim2 = trim($_POST["signInPass"]);
                $strip2 = strip_tags($trim2);
                $filter2 = $strip2;
                $sign2 = $filter2;
                $salt = '2a$07$R.gJb2U2N.FmZ4hPp1y2CN$';
                $signPass = crypt($sign2, $salt);
                echo $security;        
//========================================================================================================================
            //                                                                             Connect to Database
            //========================================================================================================================
                $db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");//CHANGE CHANGE CHANGE
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//========================================================================================================================
            //                                                                             Upload Sign Up Content
            //========================================================================================================================
$rows ="";
$emptyArray = array();
$repeatedUserId = "";
                  try {
                    $queryStr = "INSERT INTO userinfo (user, password) VALUES('$signUser', '$signPass')";
            
                    $db->query($queryStr);
            
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
              $datab = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");// CHANGE CHANGE CHANGE
                $datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                try {
                        $queryStr = "SELECT * FROM userinfo WHERE user = '$signUser'";
                        $query = $datab->prepare($queryStr);
                        $query->execute($emptyArray);
                        $rows = $query->fetchAll();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                //1. if() This will tell us whether there is more than one username already on the database.
                //2. else() Means this is the first time the database has encountered this name
                if(count($rows) > 1){
                    $repeatedUserId = $rows[1]["id"];
                    try {
                        $queryStr = "DELETE FROM userinfo WHERE id ='$repeatedUserId'";
                        $query = $datab->prepare($queryStr);
                        $query->execute($emptyArray);
                        header('Location: ../V/errorPage.php?error=11');
                        exit();
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }  
                } 
                
                //========================================================================================================================
    //                                                                                          LOG IN                                                                                            
   //========================================================================================================================
            } else { //the if statement pertaining to this was if there was NO sign up fields filled in, check to see if the login fields have anything
                //========================================================================================================================
    //                                                                                   Collect Log In Input
           //========================================================================================================================
                if($_POST['logInUser'] == "Roaring20s" && $_POST['logInPass'] == "Magnus1993") {
                header('Location: ../V/area51Cookie.php');
                exit(); //KEEP THIS MOTHERFUCKING EXIT IN PLACE> DO NOT DELETE
            }
                if(!empty($_POST["logInUser"]) && !empty($_POST["logInPass"])){
                     //Collects form info from user and crypts password
                    $trim = trim($_POST["logInUser"]);
                    $strip = strip_tags($trim);
                    $filter = $strip;
                    $logUser = $filter;
                    $trimm = trim($_POST["logInPass"]);
                    $stripp = strip_tags($trimm);
                    $filterr = $stripp;
                    $log2 = $filterr;
                    $salt = '2a$07$R.gJb2U2N.FmZ4hPp1y2CN$';
                    $logPass = crypt($log2, $salt);
                    echo $security;
                    //========================================================================================================================
                //                                                                     Connect To DB
                //========================================================================================================================
                    $db = new PDO("mysql:host=localhost; dbname=emerald", "Roaring20s", "September22");// CHANGE CHANGE CHANGE
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $queryStr = "SELECT * FROM userinfo WHERE user='$logUser' AND password='$logPass'";
                    $arrays = array();
//========================================================================================================================
                //                                                                    Extract Data From DB
                //========================================================================================================================   
                    try {
                        $query = $db->prepare($queryStr);
                        $query->execute($arrays);
                        $row = $query->fetchAll();
                    } catch(PDOException $e){
                        echo $e->getMessage();
                    }
                    //========================================================================================================================
                //                                                         Confirm Whether User and Pass are Correct
                //                                                          IF: YES -> Upload
                //                                                          IF: NO -> Go back to createSyllabus.php
                //========================================================================================================================
                      foreach($row as $rowitem) {
                        if($logUser === $rowitem["user"] && $logPass === $rowitem["password"]){
                                    header('Location: ../V/uploadSyllabusCookie.php');
                                } else {
                                    header('Location: ../V/errorPage.php?error=3');
                        } 
                        }
                    }
        }
    }
    }
//========================================================================================================================
//========================================================================================================================
//                                                                                     Search for Syllabus Class                                                                              
//========================================================================================================================
//========================================================================================================================
class selectEntries {
    public function entryView(){
            echo "<form method='post' action=' '>";
            echo "<select name ='numberOfTasks' class='uploadSyllabusSelect expandWidth killMargin blockDiv'>";
            for($i = 1; $i < 31; $i++){
                    echo "<option value = $i>$i</option>";
                }    
            echo "</select>";
            echo "<input type='submit' name='uploadSyllabusSubmit' value='Submit #' class='uploadSyllabusSubmit expandWidth killMargin blockDiv'>";
            echo "</form>";
    }
    public function totalEntries($total){
        return $total;
    }
}


    

?>

