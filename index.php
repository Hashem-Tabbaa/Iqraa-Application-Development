<?php
    require("./header.php");
    require "./php/connection.php";
    if(isset($_SESSION["UserType"]) && $_SESSION["UserType"] == "admin")
        session_destroy();
    function getNewBooks(){
        $pdo = db::getInstance(); 
        $sql = "SELECT name,image,book.book_id FROM new_books INNER JOIN book ON new_books.book_id = book.book_id";
        $statement = $pdo-> prepare($sql);
        $statement-> execute();

        $data = $statement-> fetchAll();
        echo
        '<div id="NewBooksCarousel" class="carousel slide new-books" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">
            <h2 class="new-books-text">الكتب الجديدة</h2>
           <div class="carousel-item active">
               <div class="products-gird">';
        $counter = 0;
        foreach($data as $row){
            $counter++;
            if($counter == 6){
                echo
                ' </div>
                </div>
                <div class="carousel-item">
                    <div class="products-gird">';
                $counter = 1;
            }
            echo 
            '<div class="card product-card" id = '.$row["book_id"].'>
                <img class="card-img-top p-1 product-img" src="'.$row["image"].'"+alt="'.$row["name"].'">
                    <div class="card-body">
                    <a href="./product.php?id='.$row["book_id"].'" class="card-title">'.$row["name"].'</a>
                    </div>
                <form method="POST" action="./php/addToCart.php">
                    <button name="bookID" method="POST" class="add-toCart-btn btn" type="submit" value="'.$row["book_id"].'"><i class="fas fa-book fa-flip mr-2" style="--fa-animation-duration: 8s;"></i> اضف الكتاب لقائمتي</button>
                </form>
            </div>';
        }
        echo
        '</div>
        </div>
        </div>
        <a class="carousel-control-prev" style="width:100px" href="#NewBooksCarousel" role="button" data-slide="prev">
              <span class="carousel-control" aria-hidden="true"></span>
              <img class="carousal-btn" src="./images/previous-icon.png">
          </a>
          <a class="carousel-control-next" style="width:100px" href="#NewBooksCarousel" role="button" data-slide="next">
              <span class="carousel-control" aria-hidden="true"></span>
              <img class="carousal-btn" src="./images/next-icon.png" >
          </a>
      </div>';
        $pdo = null;
    }
    function topRated(){
        $pdo = db::getInstance();
        $sql = "SELECT name,image,book.book_id FROM top_rated INNER JOIN book ON top_rated.book_id = book.book_id";
        $statement = $pdo-> prepare($sql);
        $statement-> execute();

        $data = $statement-> fetchAll();
        echo '<div class="products-gird pb-0">';
        $counter = 0;
        foreach($data as $row){
            echo 
            '<div class="card product-card" id = '.$row["book_id"].'>
                <img class="card-img-top p-1 product-img" src="'.$row["image"].'"+alt="'.$row["name"].'">
                    <div class="card-body">
                    <a href="./product.php?id='.$row["book_id"].'" class="card-title">'.$row["name"].'</a>
                    </div>
                    <form method="POST" action="./php/addToCart.php">
                    <button name="bookID" method="POST" class="add-toCart-btn btn" type="submit" value="'.$row["book_id"].'"><i class="fas fa-book fa-flip" style="--fa-animation-duration: 8s;"></i> اضف الكتاب لقائمتي</button>
                </form>
            </div>';
        }
        echo
        '</div>';
        $pdo = null;
    }
    function getSuggestions(){
        $pdo = db::getInstance();
        $sql = "SELECT name,image,book.book_id FROM suggestions INNER JOIN book ON suggestions.book_id = book.book_id";
        $statement = $pdo-> prepare($sql);
        $statement-> execute();
        $data = $statement-> fetchAll();
        echo
        '<div id="dealsCarousel" class="carousel slide new-books" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">
            <h2 class="new-books-text">مقترحات</h2>
           <div class="carousel-item active">
               <div class="products-gird">';
        $counter = 0;
        foreach($data as $row){
            $counter++;
            if($counter == 6){
                echo
                ' </div>
                </div>
                <div class="carousel-item">
                    <div class="products-gird">';
                $counter = 1;
            }
            echo 
            '<div class="card product-card" id = '.$row["book_id"].'>
                <img class="card-img-top p-1 product-img" src="'.$row["image"].'" alt="'.$row["name"].'">
                    <div class="card-body">
                    <a href="./product.php?id='.$row["book_id"].'" class="card-title">'.$row["name"].'</a>
                    </div>
                <form method="POST" action="./php/addToCart.php">
                    <button name="bookID" method="POST" class="add-toCart-btn btn" type="submit" value="'.$row["book_id"].'"><i class="fas fa-book fa-flip" style="--fa-animation-duration: 8s;"></i> اضف الكتاب لقائمتي</button>
                </form>
            </div>';
        }
        echo
        '</div>
        </div>
        </div>
        <a class="carousel-control-prev" style="width:100px" href="#dealsCarousel" role="button" data-slide="prev">
              <span class="carousel-control" aria-hidden="true"></span>
              <img class="carousal-btn" src="./images/previous-icon.png" alt="">
          </a>
          <a class="carousel-control-next" style="width:100px" href="#dealsCarousel" role="button" data-slide="next">
              <span class="carousel-control" aria-hidden="true"></span>
              <img class="carousal-btn" src="./images/next-icon.png" alt="">
          </a>
      </div>';
        $pdo = null;
    }
    // var_dump($_SESSION);
    if(isset($_SESSION['unavailable'])){
        // sweet alert for 2 seconds
        // var_dump($_SESSION);
        echo '<script>
        Swal.fire({
            title: "خطأ",
            text: "الكتاب غير متوفر في المخزن",
            icon: "error",
            button: "اغلاق",
        });
        </script>';
        unset($_SESSION["unavailable"]);
    }
?>
<section class="colored-section" id="title">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-6">
                  <form class="search-box" action="./php/search.php" method="GET">
                      <input class="search-input text-right" placeholder="ابحث" name="book_name">
                      <button class="search-img" type="submit"><i class="fas fa-search fa-spin"></i></button>
                  </form>
                  <h1 class="big-heading">استعر كتابك المفضل </h1>
              </div>
              <div class="col-lg-6">
                  <img class="title-image" src="./images/main-book.jpg" alt="The bookstore">
              </div>
          </div>
      </div>
  </section>
  <!-- new-books -->
    <section class="white-section">
        <?php
            
            getNewBooks();
        ?>    
    </section>

  <!-- Best Seller -->
  <section class="best-seller colored-section pb-5">
      <h2 class="best-seller-text">الكتب الاعلى تقييما</h2>
      <?php
        topRated();
      ?>
  </section>

  <!-- Deals Section -->

  <section class="white-section">
     <?php
      getSuggestions();
     ?>
  </section>
  <script>
        document.querySelectorAll('.product-card').forEach(element => {
            element.addEventListener('click',(e)=>{
                // alert(element.id);
                window.location.href = "./product.php?id="+element.id;
            })
        });
  </script>
<?php
  include("./footer.php")
?>