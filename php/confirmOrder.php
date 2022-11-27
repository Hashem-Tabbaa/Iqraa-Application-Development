<?php
    // get refugee id from ajax function
    var_dump($_POST);
    $refugee_id = $_POST["refugee_id"];
    require "./connection.php";
    $pdo = db::getInstance();
    $sql = "DELETE FROM orders WHERE refugee_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$refugee_id]);
    header("location: ../adminHome.php");

?>