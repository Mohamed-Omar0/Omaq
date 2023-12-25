<?php
include "connect.php";

$firstName = htmlspecialchars(strip_tags($_POST['user_firstName']));
$secondName =  htmlspecialchars(strip_tags($_POST['user_secondName']));
$phoneNumber =  htmlspecialchars(strip_tags($_POST['user_phoneNumber']));
$email =  htmlspecialchars(strip_tags($_POST['user_email']));
$password =  htmlspecialchars(strip_tags($_POST['user_password']));
$token = htmlspecialchars(strip_tags($_POST["token"]));

$stmt = $con->prepare("SELECT * FROM tokens WHERE token = '".$token."' ");
$query = $stmt->execute();
$userToken = $stmt->fetch(PDO::FETCH_ASSOC);


if($query){

$stmt2 = $con->prepare("UPDATE `sign_up` SET `user_firstName` = '".$firstName."', `user_secondName` = '".$secondName."', `user_phoneNumber` = '".$phoneNumber."', `user_email` = '".$email."', `user_password` = '".$password."' WHERE `sign_up`.`user_email` = '".$userToken["email"]."'");
$query2 = $stmt2->execute();

$stmt3 = $con->prepare("UPDATE `tokens` SET `email` = '".$email."' WHERE `tokens`.`token` = '".$userToken["token"]."'");
$query3 = $stmt3->execute();

if($query3){
    echo json_encode("success");
}

}else {
    echo json_encode("erorr");
}

?>