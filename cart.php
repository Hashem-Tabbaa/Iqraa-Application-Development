<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false){
        header("location: ./login.php");
        exit;
    }
    include("./header.php");
    // var_dump($_SESSION);
    require "./php/connection.php";
    
    function getCartItems(){
        $pdo = db::getInstance();
        $sql = "SELECT * FROM refugee INNER JOIN my_books ON refugee.refugee_id = my_books.refugee_id
        INNER JOIN book ON book.book_id = my_books.book_id 
        INNER JOIN author ON author.author_id = book.author_id
        WHERE refugee.refugee_id = :refugee_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":refugee_id",$_SESSION["id"]);
        $stmt-> execute();
        $items = $stmt->fetchAll();
        foreach($items as $item){
            echo
            '
            <div class="cart-product-card p-4 m-2">
            <div>
            <img class="cart-products-img" src="'.$item["image"].'" alt="">
            </div>
            <div class="cart-products-info">
            <h4 class="font-weight-bold">'.$item["name"].'</h4>
            <div class="quantity-section">
            <h6 class="font-weight-bold">عدد ايام الاستعارة</h6>
            <div class="d-flex quantity-box align-items-baseline">
            <form action="./php/quantity.php" method="post" style="width:max-content">
                <button type="submit" class="btn-sm btn minus-btn circle mr-2" name="days" value = "'.($item["days"]-1).'">
                <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <input class="quantity" value="'.$item["days"].'" name="bookID"></input>
                <input type="hidden" name="bookID" value="'.$item["book_id"].'">
                <button  type="submit" class="btn btn-sm plus-btn circle ml-2" name="days" value = "'.($item["days"]+1).'">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            </form>
            </div>
            </div>
            <div class="cart-btns d-flex">
            <form action="./php/removeFromCart.php" method="POST">
            <button type="submit" class="btn remove-btn btn-dark" value="'.$item["book_id"] .'" name="bookID">حذف</button>
            </form>
            </div>
            </div>
            <div class="product-details">
            <hr>
            <p>'.$item["author_first_name"].' '.$item["author_last_name"].'(الكاتب)</p>
            <hr>
            <h5 class="cart-description">وصف الكتاب</h5>
            <p class="cart-description">'.$item["description"].'</p>
            </div>
            </div>
            ';
        }
        if(!empty($items)){
            echo
            '
            </div>
            <div class="cart-info">
            <div class="invoice">
            <h5 class="font-weight-bold"> معلومات المسكن</h5>
            <p>مخيم '.$_SESSION["camp"].' - مسكن رقم '.$_SESSION["resident_number"].'</p>
            <p>رقم المستخدم : '.$_SESSION["id"].'</p>
            <p class="note text-right   ">*يتوقع وصوله خلال يومين</p>
            <hr>
            <h5 class="font-weight-bold mb-3">تفاصيل الطلب</h5>
            ';
            foreach($items as $item){
                echo
                '
                <p>'.$item["name"].'  ( يوم '.$item["days"].' )</p>
                <hr>
                ';
            }
            echo'
            <form action="./php/placeOrder.php" method = "POST">
            	<button type="submit" class="btn btn-success mt-5">نأكيد الطلب</button>
            </form>
            ';
        }
        else{
            if(isset($_SESSION["confirmed"])){
                // show sweet alert until user click it then redirect to index.php
                echo
                '
                <script>
                    Swal.fire({
                        title: "تم تأكيد الطلب",
                        text: "يتوقع وصول الطلب خلال يومين",
                        type: "success",
                        confirmButtonText: "حسناً"
                    }).then(function(){
                        window.location.href = "./index.php";
                    });
                </script>
                ';
            }
            else {
                // sweet alert message for 2 seconds
                echo '<script>
                Swal.fire({
                    title: "خطأ",
                    text: "قائمة الكتب فارغة",
                    icon: "error",
                    button: "اغلاق",
                }).then(function(){
                    window.location.href = "./index.php";
                });
                </script>';

            }
        }
        unset($_SESSION["confirmed"]);
    }
    
?>
<h4 class="font-weight-bold text-left mt-3 ml-4 text-right">قائمة كتبي</h4>
<div class="d-flex cartPage">
    <div class="cart-products" style="width:75%">
        <?php
            getCartItems();
        ?>
        </div>
    </div>
</div>
<!-- <script>
    document.querySelectorAll('.plus-btn').forEach(element => {
        element.addEventListener('click', (e) => {
            var quantityID = "#v";
          	for(let i = 1 ; i<element.id.length ; i++){
            	quantityID += element.id[i];
            }
            var value = parseInt(document.querySelector(quantityID).value);
            if(value < 10) 
                document.querySelector(quantityID).value = value+1;
        });
    });
    document.querySelectorAll('.minus-btn').forEach(element => {
        element.addEventListener('click', (e) => {
            var quantityID = "#v";
          	for(let i = 1 ; i<element.id.length ; i++){
            	quantityID += element.id[i];
            }
            // alert(quantityID);
            var value = parseInt(document.querySelector(quantityID).value);
            if(value > 1) 
                document.querySelector(quantityID).value = value-1;
        });
    });
</script> -->
<?php
    include("./footer.php");
?>