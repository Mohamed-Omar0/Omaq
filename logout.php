<?php
include "connect.php";

$token = htmlspecialchars(strip_tags($_POST["token"]));

$stmt = $con->prepare("SELECT * FROM tokens WHERE token = '".$token."' ");
$query = $stmt->execute();
$userToken = $stmt->fetch(PDO::FETCH_ASSOC);


$stmt2 = $con->prepare("DELETE FROM tokens WHERE email = '".$userToken["email"]."' ");
$stmt2->execute();
$count= $stmt2->rowCount();

if($count > 0){
    echo json_encode("success");
}
else{
    echo json_encode("error");
}
?>