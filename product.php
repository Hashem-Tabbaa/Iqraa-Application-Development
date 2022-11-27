<?php
    require "./php/connection.php";
    
    $pdo = db::getInstance();
    $sql = "SELECT * FROM book INNER JOIN author ON book.author_id = author.author_id Where book.book_id = $_GET[id]";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute();
    $data = $stmt->fetch();
    
    // if data is empty show redirect to the HTTP_REFERER
    if(empty($data)){
        session_start();
        // set unavailabe to true in session
        $_SESSION["unavailable"] = true;
        header("Location: ./index.php");
        exit();
    }
    include("./header.php");
?>
<div class="productPage-grid">
    <div class="product-img-productPage p-5">
        <img src="<?php echo$data["image"]?>" alt="">
    </div>
    <div class="product-info p-5">
        <h3 class="font-weight-bold"><?php echo$data["name"]?></h3>
        <p><?php echo$data["author_first_name"].' '.$data["author_last_name"]?> (Author)</p>
        <form action="./php/addToCart.php" method="POST">
            <button class="add-toCart-btn-productPage btn btn-primary mt-3" type="submit" name="bookID" value="<?php echo $data["book_id"]?>"><i
                    class="fas fa-book"></i> اضف الكتاب لقائمتي</button>
        </form>
        <hr>
        <h3 class="font-weight-bold"> وصف الكتاب</h3>
        <p><?php echo$data["description"]?></p>
        <hr>
        <h3 class="font-weight-bold">عن الكاتب</h3>
        <p><?php echo$data["about_author"]?></p>
    </div>
</div>
<?php
  include("./footer.php")
?>