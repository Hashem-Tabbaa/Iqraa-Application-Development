<?php
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
      header("location: ./adminHome.php");
      exit;
  }
  include("./adminHeader.php");
?>
 <div class="login p-5 w-100">
        <div class="w-100">
            <main class="form-signin m-auto w-75">
                <form method="POST" action="./php/authentication.php">
                    <input type="hidden" value="admin" name="UserType">
                    <img src="./images/user-login.png" alt="">
                    <h1 class="h3 mt-3 fw-normal">تسجيل الدخول</h1>
                    
                    <div class="form-floating mb-3 mt-3">
                        <label class="font-weight-bold" for="refugeeID">رقم المستخدم</label>
                        <input type="refugeeID" class="form-control w-50 m-auto" id="refugeeID" placeholder="123456789" name="refugeeID">
                    </div>
                    <div class="form-floating">
                        <label class="font-weight-bold" for="password">كلمة المرور</label>
                        <input type="password" class="form-control m-auto w-50" id="password" placeholder="Password" name="password">
                    </div>
                    <button class="login-btn w-50 btn btn-lg btn-primary mt-3" type="submit">تسجيل الدخول</button>
                </form>
            </main>
        </div>
    </div>
<?php
  include("./footer.php")
?>