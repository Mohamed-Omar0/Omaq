<?php 
    include "connect.php";

    $stmt = $con->prepare("SELECT * FROM projects");
    $query = $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($query){
        echo json_encode($projects);
    }else {
        echo json_encode("error");
    }
?>