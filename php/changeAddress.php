<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false){
        header("location: ../login.php");
        exit;
    }   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require "./connection.php";
        $pdo = db::getInstance();
        $sql = "UPDATE customer SET street_name = :street_name, building_number = :building_number ,city = :city, place = :place WHERE customer_id = $_SESSION[id]";
        $stmt = $pdo-> prepare($sql);

        $stmt->bindParam(":street_name",$_POST["streetName"], PDO::PARAM_STR);
        $stmt->bindParam(":building_number",$_POST["buildingNumber"], PDO::PARAM_INT);
        $stmt->bindParam(":city",$_POST["city"], PDO::PARAM_STR);
        $stmt->bindParam(":place",$_POST["place"], PDO::PARAM_STR);

        var_dump($_POST);
        $stmt-> execute();
        header("location: ../account.php");
    }else{
        header("location: ../account.php");
    }
?>