<?php
    require "./connection.php";
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $pdo = db::getInstance();
        $sql = "SELECT book_id FROM book WHERE name = :name";
        $stmt = $pdo->prepare($sql);
        $stmt-> bindParam(":name", $_GET["book_name"], PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch();
        // var_dump($stmt->rowCount() == 1);
        if($stmt->rowCount() == 1)header("location: ../product.php?id=".$data["book_id"]);
        else{ 
            session_start();
            $_SESSION["unavailable"] = true;
            header("location: $_SERVER[HTTP_REFERER]");
        }
        $pdo = null;
    }
?>