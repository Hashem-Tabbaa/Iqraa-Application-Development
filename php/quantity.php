<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require ("./connection.php");
        session_start();
        // echo var_dump($_POST);
        $refugeeID = $_SESSION["id"];
        $bookID = $_POST["bookID"];
        $days = $_POST["days"];
        $pdo = db::getInstance();
        $sql = "UPDATE my_books SET days = :days WHERE refugee_id = :refugeeID AND book_id = :bookID";
        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(":days", $days, PDO::PARAM_INT);
        $stmt->bindParam(":refugeeID", $refugeeID, PDO::PARAM_STR);
        $stmt->bindParam(":bookID", $bookID, PDO::PARAM_STR);
        $stmt-> execute();
        $pdo = null;
        header("location: ../cart.php");
        exit;
    }
?>