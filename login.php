<?php
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
      header("location: ./index.php");
      exit;
  }
  include("./header.php");
?>
 <div class="login p-5 w-100">
        <div class="w-100">
            <main class="form-signin m-auto w-75">
                <form method="POST" action="./php/authentication.php">
                    <img src="./images/user-login.png" alt="">
                    <h1 class="h3 mt-3 fw-normal">تسجيل الدخول</h1>
                    
                    <div class="form-floating mb-3 mt-3">
                        <label class="font-weight-bold" for="refugeeID">رقم اللاجئ</label>
                        <?php
                            // echo var_dump($_SESSION["login_status"]);
                            if(isset($_SESSION["login_status"]) && $_SESSION["login_status"] == "حساب غير موجود"){
                                echo '<input type="refugeeID" class="form-control w-75 m-auto" id="refugeeID" placeholder="123456789" name="refugeeID" style="border-color:red;">'.$_SESSION["login_status"];
                            }else{
                                echo'
                                <input type="refugeeID" class="form-control w-50 m-auto" id="refugeeID" placeholder="123456789" name="refugeeID">
                                ';
                            }
                        ?>
                    </div>
                    <div class="form-floating">
                        <label class="font-weight-bold" for="password">كلمة المرور</label>
                        <?php
                            if(isset($_SESSION["login_status"]) && $_SESSION["login_status"] == "كلمة المرور غير صحيحة"){
                                echo '<input type="password" class="form-control m-auto w-50" id="password" placeholder="Password" name="password" style="border-color:red;">'.$_SESSION["login_status"];
                            }else{
                                echo'
                                <input type="password" class="form-control m-auto w-50" id="password" placeholder="Password" name="password">
                                ';
                            }
                        ?>
                    </div>
                    <button class="login-btn w-50 btn btn-lg btn-primary mt-3" type="submit">تسجيل الدخول</button>
                </form>
                <h5 class="create-account-text mt-4">مستخدم جديد؟</h5>
                <a href="./signup.php" class="signup-btn w-50 btn btn-lg btn-primary mt-3" type="submit">انشاء حساب</a>
                <a href="./adminlogin.php m-0" class="d-block text-left" style="onhover">Admin login</a>
            </main>

        </div>
        <!-- <div class="login-image">
            <img src="./images/login-book.png" alt="">
        </div> -->
    </div>
<?php
  include("./footer.php");
  unset($_SESSION["login_status"]);
?>