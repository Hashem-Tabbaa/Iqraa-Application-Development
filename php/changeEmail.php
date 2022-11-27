<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false){
        header("location: ../login.php");
        exit;
    } 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require "./connection.php";
        session_start();
        if(isset($_SESSION["changeEmail_status"]))
            unset($_SESSION["changeEmail_status"]);
        $pdo = db::getInstance();
        $sql = "SELECT password FROM customer WHERE customer_id = $_SESSION[id]";
        $stmt = $pdo-> prepare($sql);
        $stmt-> execute();
        $data = $stmt->fetch();
        if(strcmp($data["password"],$_POST["password"]) == 0){
            $sql = "UPDATE customer SET email = :email WHERE customer_id = $_SESSION[id]";
            $stmt = $pdo-> prepare($sql);
            $stmt->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
            try{
                $stmt->execute();
            }catch(PDOException $e){
                $_SESSION["changeEmail_status"] = 4;
            }
        }else $_SESSION["changeEmail_status"] = 1;
        header("location: ../account.php");
    }else header("location: ../login.php");
?>