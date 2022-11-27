<?php
    require "./connection.php";
    session_start();
    if(isset($_SESSION["changePhone_status"]))
        unset($_SESSION["changePhone_status"]);
    $pdo = db::getInstance();
    $sql = "SELECT password FROM customer WHERE customer_id = $_SESSION[id]";
    $stmt = $pdo-> prepare($sql);
    $stmt-> execute();
    $data = $stmt->fetch();
    if(strcmp($data["password"],$_POST["password"]) == 0){
        $sql = "UPDATE customer SET phone_number = :phone_number WHERE customer_id = $_SESSION[id]";
        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(":phone_number", $_POST["phoneNumber"], PDO::PARAM_STR);
        $stmt->execute();
    }else $_SESSION["changePhone_status"] = 1;
    header("location: ../account.php");
?>