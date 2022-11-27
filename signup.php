<?php
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
      header("location: ./index.php");
      exit;
  }
  include("./header.php");
//   var_dump($_SESSION);
?>
<div class="login w-100">
    <div class="w-100">
        <main class="form-signin m-auto">
            <form method="POST" action="./php/register.php">
                <img src="./images/user-login.png" alt="">
                <h1 class="h3 mt-3 fw-normal">انشاء حساب</h1>
                <div class="form-floating mt-3 d-flex flex-wrap justify-content-around">
                    <div class="last-name">
                        <label class="font-weight-bold" for="lastName">*اسم العائلة</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="first-name mr-2">
                        <label class="font-weight-bold" for="firstName">*الاسم الأول</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                </div>
                <div class="form-floating mt-3">
                    <label class="font-weight-bold" for="refugeeID">*رقم اللاجئ</label>
                    <input type="text" class="form-control w-50 m-auto" id="refugeeID" placeholder="123456789" name="refugeeID"
                        required <?php if(isset($_SESSION["uniqueRefugeeID_status"])) echo'style="border-color:red"';?>>
                <?php
                    // var_dump($_SESSION);
                    if(isset($_SESSION["uniqueRefugeeID_status"]) && $_SESSION["uniqueRefugeeID_status"] == 1)
                        echo'<p>رقم اللاجئ غير صالح</p>';
                    else if(isset($_SESSION["uniqueRefugeeID_status"]) && $_SESSION["uniqueRefugeeID_status"] == 2)
                        echo'<p>رقم اللاجئ مسجل مسبقا</p>';
                ?>   
                </div>
                <div class="d-flex felx-wrap mt-3 justify-content-around">
                    <div class="form-floating">
                        <label class="font-weight-bold" for="passwordAgain">*تأكيد كلمة المرور</label>
                        <input type="password" class="form-control" id="passwordAgain" placeholder="Password"
                        name="passwordAgain" required>
                        <p class="checkPassword"></p>
                    </div>
                    <div class="form-floating mr-2">
                        <label class="font-weight-bold" for="password">*كلمة المرور</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                            required>
                        <p class="passwordLength"></p>
                    </div>
                </div>
                <div class="d-flex flex-wrap mt-3 justify-content-around">
                    <div class="form-floating">
                        <label class="font-weight-bold" for="phoneNumber">رقم الهاتف (إن وجد)</label>
                        <input type="tel" class="form-control m-auto" id="phoneNumber" placeholder="07xxxxxxxx"
                            name="phoneNumber">
                        <p class="checkPhoneNumber"></p>
                    </div>
                    <div class="form-floating">
                        <label for="residentNumber">رقم السكن</label>
                        <input type="text" class="form-control m-auto" id="residentNumber" name="residentNumber" required>
                    </div>
                </div>
                <div class="form-floating mt-3">
                    <label class="font-weight-bold" for="camp">*المخيم</label>
                    <select class="form-select ml-2" aria-label="Default select example" name="camp">
                        <option value="zaatri">الزعتري</option>
                        <option value="azraq">الأزرق</option>
                    </select>
                </div>
                <button class="login-btn w-50 m-auto btn btn-lg btn-primary mt-3" id="signupBtn" type="submit">انشاء حساب</button>
            </form>
            <h5 class="create-account-text mt-4 mb-4">لديك حساب؟</h5>
            <a href="./login.php" class="signup-btn w-50 m-auto btn btn-lg btn-primary mt-3" type="submit">تسجيل الدخول</a>
        </main>

    </div>
    <!-- <div class="login-image">
        <img src="../images/login-book.png" alt="">
    </div> -->
</div>
<script>
    document.querySelector('#password').addEventListener('keyup', (element)=>{
        var password = document.querySelector('#password').value;
        var passwordAgain = document.querySelector('#passwordAgain').value;
        if (password !== passwordAgain && passwordAgain.length > 0) {
            document.querySelector('.checkPassword').innerHTML = "*كلمة المرور غير متطابقة";
            document.querySelector('#signupBtn').disabled = true;
        } else {
            document.querySelector('.checkPassword').innerHTML = "";
            document.querySelector('#signupBtn').disabled = false;
        }
        if(password.length < 8 && password.length>0){
            document.querySelector(".passwordLength").innerHTML = "*كلمة المرور قصيرة";
            document.querySelector("#signupBtn").disabled = true;
        }else {
            document.querySelector('.passwordLength').innerHTML = "";
            document.querySelector('#signupBtn').disabled = false;
        }
    });
    document.querySelector('#passwordAgain').addEventListener('keyup', (element) => {
        var password = document.querySelector('#password').value;
        var passwordAgain = document.querySelector('#passwordAgain').value;
        if ((password !== passwordAgain && passwordAgain.length > 0)) {
            document.querySelector('.checkPassword').innerHTML = "*كلمة المرور غير متطابقة";
            document.querySelector('#signupBtn').disabled = true;
        }
        else {
            document.querySelector('.checkPassword').innerHTML = "";
            document.querySelector('#signupBtn').disabled = false;
        }
        if(passwordAgain.length<8){
            document.querySelector('#signupBtn').disabled = true;
        } 
    });
    document.querySelector('#phoneNumber').addEventListener('keyup', (element) => {
        var phoneNumber = document.querySelector('#phoneNumber').value;
        
        var valid = !isNaN(phoneNumber); //check if the phone number does not contain text using isNaN function.

        //if the phone number length is greater than 2, check the if the first three digits are valid jordanian compainies.
        if (phoneNumber.length > 2){ 
            var firstThreeDigits = phoneNumber[0] + phoneNumber[1] + phoneNumber[2];
            if(firstThreeDigits !== "079" && firstThreeDigits !== "078" && firstThreeDigits !== "077")
                valid = !valid;
        }

        //check if the phone number length is valid (10 digits)
        if ((phoneNumber.length > 0 && phoneNumber.length < 10) || !valid || phoneNumber.length>10) {
            document.querySelector('.checkPhoneNumber').innerHTML = "*رقم الهاتف غير صحيح";
            document.querySelector('#signupBtn').disabled = true;
        } else {
            document.querySelector('.checkPhoneNumber').innerHTML = "";
            document.querySelector('#signupBtn').disabled = false;
        }
    });
</script>
<?php
    session_destroy();
    require("./footer.php");
?>