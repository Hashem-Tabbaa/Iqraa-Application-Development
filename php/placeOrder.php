<?php
	session_start();
	require "./connection.php";
    $pdo = db::getInstance();
    // when confirming order move the order to orders table
    // get the books_ids from my_books table using refugee_id
    $sql = "SELECT * FROM my_books WHERE refugee_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["id"]]);
    $books = $stmt->fetchAll();
    // insert the books_ids to orders table
    
    $sql = "INSERT INTO orders (refugee_id, book_id, days, order_date) VALUES (?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    foreach($books as $book){
        try{
            $stmt->execute([$_SESSION["id"], $book["book_id"], $book["days"]]);
        }
        catch(PDOException $e){
            continue;
        }
    }
    // delete the books from my_books table
    $sql = "DELETE FROM my_books WHERE refugee_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["id"]]);
    $pdo = null;
    $_SESSION["confirmed"] = true;
    header("location: ../cart.php");
?>