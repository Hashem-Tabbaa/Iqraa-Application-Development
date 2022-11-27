<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false){
        header("location: ../login.php");
        exit;
    }
    require "./connection.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
            $pdo = db::getInstance();
            $sql = "INSERT INTO my_books (book_id, refugee_id) VALUES (:book_id, :refugee_id);";
            $stmt = $pdo-> prepare($sql);
            $stmt->bindParam(":book_id",$_POST["bookID"],PDO::PARAM_INT);
            $stmt->bindParam(":refugee_id",$_SESSION["id"],PDO::PARAM_INT);
            try{
                $stmt-> execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            $pdo = null;
        }
        header("location: $_SERVER[HTTP_REFERER]");
        exit;
    }
}
?>