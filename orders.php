<?php
    include "connect.php";

    $orderType = htmlspecialchars(strip_tags($_POST['orderType']));
    $firstName = htmlspecialchars(strip_tags($_POST['agent_firstName']));
    $secondName =  htmlspecialchars(strip_tags($_POST['agent_secondName']));
    $phoneNumber =  htmlspecialchars(strip_tags($_POST['agent_phoneNumber']));
    $email =  htmlspecialchars(strip_tags($_POST['agent_email']));
    $message =  htmlspecialchars(strip_tags($_POST['agent_message']));
    $token = htmlspecialchars(strip_tags($_POST["token"]));

    $stmt = $con->prepare("SELECT * FROM tokens WHERE token = '".$token."' ");
    $query = $stmt->execute();
    $userToken = $stmt->fetch(PDO::FETCH_ASSOC);

    if($query){
        $stmt2 = $con->prepare ("INSERT INTO `orders` (`orderType`,`agent_firstName`, `agent_secondName`, `agent_phoneNumber`, `agent_email`, `agent_message`,`user_email`) 
        VALUES ('".$orderType."', '".$firstName."', '".$secondName."','".$phoneNumber."', '".$email."', '".$message."', '".$userToken["email"]."')");
        $query2 = $stmt2->execute();
        if($query2){
            echo json_encode("success");
        }else {
            echo json_encode("erorr");
        }
    }else{
        echo json_encode("erorr");
    };
?>