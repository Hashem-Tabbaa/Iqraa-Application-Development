<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false || $_SESSION["UserType"] == "admin"){
        header("location: ./login.php");
        exit;
    }
    include("./header.php");
    require "./php/connection.php";
    $pdo = db::getInstance();
    $sql = "SELECT * FROM refugee WHERE refugee.refugee_id = $_SESSION[id]";
    $stmt = $pdo-> prepare($sql);
    $stmt-> execute();
    $data = $stmt-> fetch();
    $data["refugee_camp"] = ($data["refugee_camp"] == "zaatri") ? "زعتري" : "الأزرق";
?>
<div class="accountPage d-flex p-5 ">
    <div class="addressInfo card">
        <h4 class="card-title">معلومات السكن</h4>
        <hr class="m-0">
        <div class="card-body text-left d-flex justify-content-between">
            <div class="changeAccountInfo addressInfoSection">
                <div class="Unhidden">
                    <h6 class="font-weight-bold text-left">المخيم: </h6>
                    <p><?php echo $data["refugee_camp"]?></p>
                    <h6 class="font-weight-bold">رقم المسكن:</h6>
                    <p><?php echo $data["resident_number"]?></p>
                </div>  
            </div>              
        </div>
    </div>
    <div class="securityAndlogin card">
        <h4 class="card-title">المعلومات الشخصية</h4>
        <hr class="m-0">
        <div class="card-body text-left">
            <div class="d-flex changeAccountInfo">
                <p><?php echo $data["first_name"]." ".$data["last_name"]?></p>
                <h6 class="font-weight-bold text-right ml-2"> :الاسم </h6>
            </div>
            <hr>
            <div class="d-flex changeAccountInfo">
                <p><?php echo $data["phone_number"]?></p>
                <h6 class="font-weight-bold ml-2"> :رقم الهاتف</h6>
            </div>
            
            <hr>
            <div class="d-flex changeAccountInfo">
                <button class="btn btn-dark btn-sm changebtn mr-5" id="changePassword">تغيير</button>
                <p>************</p>
                <h6 class="font-weight-bold text-right ml-2">:كلمة السر</h6>
            </div>
            <?php 
                if(isset($_SESSION["changePassword_status"])) 
                    echo'<div class="changePasswordSection">';
                else
                    echo'<div class="changePasswordSection d-none">';
             ?>
                <form action="./php/changePassword.php" method="POST">
                    <div class="form-floating">
                        <label class="font-weight-bold m-0" for="password">كلمة السر القديمة</label>
                        <input type="password" class="form-control" name="oldPassword" required <?php if(isset($_SESSION['changePassword_status']) && $_SESSION['changePassword_status'] == 2) echo'style="border-color:red"';?>>
                        <?php if(isset($_SESSION['changePassword_status']) && $_SESSION['changePassword_status'] == 2) 
                        echo
                        '<p>كلمة السر غير صحيحة</p>'
                        ;?>
                    </div>
                    <div class="form-floating">
                        <label class="font-weight-bold m-0" for="password">كلمة السر الجديدة </label>
                        <input type="password" class="form-control" name="newPassword" required <?php if(isset($_SESSION['changePassword_status']) && $_SESSION['changePassword_status'] == 1) echo'style="border-color:red"';?>>
                        <?php if(isset($_SESSION['changePassword_status']) && $_SESSION['changePassword_status'] == 1) 
                        echo
                        '<p>كلمة المرور يجب ان تكون من 8 رموز او اكثر</p>'
                        ;?> 
                    </div>
                    <div class="form-floating">
                        <label class="font-weight-bold m-0" for="password">تأكيد كلمة السر الجديدة</label>
                        <input type="password" class="form-control" name="newPasswordAgain" required <?php if(isset($_SESSION['changePassword_status']) && $_SESSION['changePassword_status'] == 3) echo'style="border-color:red"';?>>
                        <?php if(isset($_SESSION['changePassword_status']) && $_SESSION['changePassword_status'] == 3) 
                        echo
                        '<p>كلمة المرور غير متطابقة</p>'
                        ;?>
                    </div>
                    <button class="btn btn-primary btn-sm mt-2 float-right" type="submit">تغيير</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // change password button unhide the change password section
    $(document).ready(function(){
        $("#changePassword").click(function(){
            if($(".changePasswordSection").hasClass("d-none")){
                $(".changePasswordSection").removeClass("d-none");
            }else{
                $(".changePasswordSection").addClass("d-none");
            }
        });
    });

</script>
<?php
unset($_SESSION["changePassword_status"]);
include("./footer.php");
?>