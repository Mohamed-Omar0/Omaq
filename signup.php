<?php
    include "connect.php";

    $firstName = htmlspecialchars(strip_tags($_POST['user_firstName']));
    $secondName =  htmlspecialchars(strip_tags($_POST['user_secondName']));
    $phoneNumber =  htmlspecialchars(strip_tags($_POST['user_phoneNumber']));
    $email =  htmlspecialchars(strip_tags($_POST['user_email']));
    $password =  htmlspecialchars(strip_tags($_POST['user_password']));

    $stmt = $con->prepare("SELECT * FROM sign_up WHERE user_email = '".$email."' || user_phoneNumber = '".$phoneNumber."' ");
    $stmt->execute();
    $count= $stmt->rowCount();

    if($count > 0 || $email == null){
        echo json_encode("erorr");
    }else{
        $stmt2 = $con->prepare ("INSERT INTO `sign_up` (`user_firstName`, `user_secondName`, `user_phoneNumber`, `user_email`, `user_password`) 
        VALUES ('".$firstName."', '".$secondName."', '".$phoneNumber."','".$email."', '".$password."')");
        $query = $stmt2->execute();
        if($query){
            echo json_encode("success");
        }else {
            echo json_encode("erorr");
        }
    };
?>