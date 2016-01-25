<?php

       require_once("../M/model.php");

if($_POST['logInUser'] == "Roaring20s" && $_POST['logInPass'] == "Magnus1993") {
                header('Location: ../V/area51Cookie.php');
                exit(); 
            }

        if((empty($_POST["signInUser"]) || empty($_POST["signInPass"])) && (empty($_POST["logInUser"]) || empty($_POST["logInPass"]))){
               header('Location: ../V/errorPage.php?error=3');
               exit();
        }
        if($_POST["signInPassAgain"] != $_POST["signInPass"]) {
            header('Location: ../V/errorPage.php?error=4');
            exit();
        }
// Now what if the user successfully creates a contact, well bring him to create a syllabus, also!!! Remember to create more cookies
        $contactInfoDefense = new defenseSystem();
        $userSignUp = new contactInfo();

        $userSignUp->uploadContactInfo($contactInfoDefense->honeyDefense());
        
        if(!empty($_POST["signInUser"]) && !empty($_POST["signInPass"])){
            header('Location: ../V/uploadSyllabusCookie.php');
            exit();
        }
?>




