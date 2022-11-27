<?php
    require "./connection.php";
    session_start();
    if(isset($_SESSION["changePassword_status"]))
        unset($_SESSION["changePassword_status"]);
    $pdo = db::getInstance();
    $sql = "SELECT password FROM refugee WHERE refugee_id = $_SESSION[id]";
    $stmt = $pdo-> prepare($sql);
    $stmt-> execute();
    $data = $stmt->fetch();
    if(strcmp($data["password"],$_POST["oldPassword"]) == 0 && strcmp($_POST["newPasswordAgain"],$_POST["newPassword"]) == 0){
        if(strlen($_POST["newPassword"]) >= 8){
            $sql = "UPDATE refugee SET password = :password WHERE refugee_id = $_SESSION[id]";
            $stmt = $pdo-> prepare($sql);
            $stmt->bindParam(":password", $_POST["newPassword"], PDO::PARAM_STR);
            $stmt->execute();
        }else $_SESSION["changePassword_status"] = 1;
    }
    else if(strcmp($_POST["oldPassword"],$data["password"]) != 0)
        $_SESSION["changePassword_status"] = 2;
    else
        $_SESSION["changePassword_status"] = 3;
    
    header("location: ../account.php");
?>