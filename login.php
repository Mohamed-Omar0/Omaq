<?php
include "connect.php";

$email = htmlspecialchars(strip_tags($_POST['email']));;
$password = htmlspecialchars(strip_tags($_POST['password']));; 

$_SESSION['token'] = md5(uniqid().rand(0, 9999999));


$stmt = $con->prepare("SELECT * FROM sign_up WHERE user_email = '".$email."' AND user_password = '".$password."' ");
$stmt->execute();
$count= $stmt->rowCount();

if($count > 0){
    $stmt2 = $con->prepare ("INSERT INTO `tokens` (`token`, `email`) 
    VALUES ('".$_SESSION['token']."', '".$email."')");
    $stmt2->execute();
    echo json_encode($_SESSION['token']);
}
else{
    echo json_encode("error");
}
?>