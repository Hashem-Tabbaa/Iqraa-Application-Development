<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        session_start();
        require "connection.php";
        $pdo = db::getInstance();

        if(isset($_POST["UserType"]) && $_POST["UserType"] == "admin"){
            $sql = "SELECT * FROM admin WHERE id = ? AND password = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_POST["refugeeID"], $_POST["password"]]);
            $user = $stmt->fetch();
            if($user){
                $_SESSION["loggedin"] = true;
                $_SESSION["UserType"] = "admin";
                header("location: ../adminHome.php");
                exit;
            }else{
                $_SESSION["loggedin"] = false;
                $_SESSION["UserType"] = "";
                header("location: ../adminLogin.php");
                exit;
            }
       
        }
        $refugeeID = $_POST["refugeeID"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM refugee WHERE refugee_id = :refugeeID";

        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(":refugeeID", $refugeeID, PDO::PARAM_STR);
        $stmt-> execute();
        if($stmt-> rowCount() == 1){
            if($row = $stmt-> fetch()){
                if($row["password"] == $password){
                    // session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row["refugee_id"];
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $row["first_name"];
                    $_SESSION["resident_number"] = $row["resident_number"];
                    $_SESSION["camp"] = ($row["refugee_camp"] == "zaatri") ? "زعتري" : "الأزرق";
                    $_SESSION["UserType"] = "refugee";
                    header("location: ../index.php");
                    exit;
                }
                $_SESSION["login_status"] = "كلمة المرور غير صحيحة";
            }
        }else{
            $_SESSION["login_status"] = "حساب غير موجود";
        }
        header("location: ../login.php");
    }else{
        header("location: ../login.php");
    }
?>