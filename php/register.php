<?php
    require "connection.php";

    // if(isset($_SESSION["loggedin"] && $_SESSION["loggedin"] === true)){
    //     header("location: ./index.php");
    //     exit;
    // }
    $pdo = db::getInstance();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $password = $_POST["password"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $phoneNumber = $_POST["phoneNumber"];
        $refugeeID = $_POST["refugeeID"];
        $camp = $_POST["camp"];
        $passwordAgain = $_POST["passwordAgain"];
        $residentNumber = $_POST["residentNumber"];
        
        // verify the refugeeID from the verified_refugees table in the database
        $sql = "SELECT * FROM verified_refugees WHERE refugee_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$refugeeID]);
        $result = $stmt->fetch();
        // if the result is empty then the refugeeID is not in the database
        if(empty($result)){
            session_start();
            $_SESSION["uniqueRefugeeID_status"] = 1;
            var_dump($_SESSION);
            header("location: ../signup.php");
            exit;
        }
        // var_dump($result);
        $sql = "SELECT refugee_id FROM refugee WHERE refugee_id = :refugeeID";
        $statement = $pdo-> prepare($sql);
        $statement-> bindParam(":refugeeID", $refugeeID, PDO::PARAM_STR);
        if($statement->execute()){  
            if($statement->rowCount() == 1){
                session_start();
                $_SESSION["uniqueRefugeeID_status"] = 2;
                header("location: ../signup.php");
                exit;
            }
        }else echo 'Something went wrong... Try again later';
        unset($statement);

        $sql = "INSERT INTO refugee (refugee_id, password, first_name, last_name, phone_number, refugee_camp, resident_number) VALUES (:refugeeID, :password, :firstName, :lastName, :phoneNumber, :camp, :residentNumber)";
        $statement = $pdo-> prepare($sql);
        $statement-> bindParam(":refugeeID", $refugeeID, PDO::PARAM_STR);
        $statement-> bindParam(":firstName", $firstName, PDO::PARAM_STR);
        $statement-> bindParam(":lastName", $lastName, PDO::PARAM_STR);
        $statement-> bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
        $statement-> bindParam(":password", $password, PDO::PARAM_STR);
        $statement-> bindParam(":camp", $camp, PDO::PARAM_STR);
        $statement-> bindParam(":residentNumber", $residentNumber, PDO::PARAM_STR);

        $statement-> execute();
        unset($statement);
        $pdo = null;
        header("location: ../login.php");
    }
?>