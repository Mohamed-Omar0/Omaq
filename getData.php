<?php 
    include "connect.php";

    $token = htmlspecialchars(strip_tags($_POST["token"]));

    $stmt = $con->prepare("SELECT * FROM tokens WHERE token = '".$token."' ");
    $query = $stmt->execute();
    $userToken = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $con->prepare("SELECT * FROM sign_up WHERE user_email = '".$userToken["email"]."' ");
    $query2 = $stmt2->execute();
    $userData = $stmt2->fetch(PDO::FETCH_ASSOC);

    if($query2){
        echo json_encode($userData);
    }else {
        echo json_encode("error");
    }
?>