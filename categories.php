    <?php
        include("./header.php");
        require "./php/connection.php";
        function getCategory($category_id, $category_name){
            $pdo = db::getInstance();
            $sql = "SELECT name,image,book_id FROM book WHERE category_id = $category_id";
            $stmt = $pdo->prepare($sql);
            $stmt-> execute();
            $category = "";
            $data = $stmt->fetchAll();
            if($category_name == "Historical")
                $category = "تاريخي";
            else if($category_name == "Scientific")
                $category = "علمي";
            else if($category_name == "Biography")
                $category = "سيرة ذاتية";
            else if($category_name == "For-Children")
                $category = "للأطفال";
            else if($category_name == "Humor-games")
                $category = "الغاز و تسلية";
            else if($category_name == "Poetry")
                $category = "قصائد";
            else if($category_name == "Novels")
                $category = "روايات";
            echo
            '
            <div class="category '.$category_name.'">
            <h4 class="font-weight-bold text-left p-4">'.$category.'</h4>
            <div class="products-gird">
            ';
            foreach($data as $row){
                echo
                '
                <div class="card product-card" id = '.$row["book_id"].'>
                    <img class="card-img-top p-1 product-img" src="'.$row["image"].'" alt="'.$row["name"].'">
                    <div class="card-body">
                        <a href="./product.php?id='.$row["book_id"].'" class="card-title">'.$row["name"].'</a>
                    </div>
                    <form method="POST" action="./php/addToCart.php">
                        <button name="bookID" class="add-toCart-btn btn" type="submit" value="'.$row["book_id"].'"><i class="fas fa-book fa-flip mr-2" style="--fa-animation-duration: 3s;"></i> اضف الكتاب لقائمتي</button>
                    </form>
                </div>
                ';
            }
            echo'</div><hr></div>';
            
            $pdo = null;
        }

    ?>  
    <div class="categories-container d-flex">
            <aside class="categories-checkbox sticky-top">
                <div>
                    <input type="checkbox" value="Historical" id="Historical" checked>
                    <label for="Historical">تاريخي</label>
                </div>

                <div>
                    <input type="checkbox" value="Scientific" id="Scientific">
                    <label for="Scientific">عملي</label>
                </div>

                <div>
                    <input type="checkbox" value="Biography" id="Biography">
                    <label for="Biography">سيرة ذاتية</label>
                </div>

                <div>
                    <input type="checkbox" value="For-Children" id="For-Children">
                    <label for="For-Children">مخصص للاطفال</label>
                </div>

                <div>
                    <input type="checkbox" value="Humor-games" id="Humor-games">
                    <label for="Humor-games">الغاز و تسلية</label>
                </div>

                <div>
                    <input type="checkbox" value="Poetry" id="Poetry">
                    <label for="Poetry">قصائد</label>
                </div>

                <div>
                    <input type="checkbox" value="Novels" id="Novels">
                    <label for="Novels">روايات</label>
                </div>
            </aside>
            <div class="categories">
                <?php
                    getCategory(2,"Historical");
                    getCategory(4,"Scientific");
                    getCategory(5,"Biography");
                    getCategory(3,"For-Children");
                    getCategory(6,"Humor-games");
                    getCategory(7,"Poetry");
                    getCategory(1,"Novels");
                    ?>        
            </div>
    </div>
    <script>
        document.querySelectorAll('input').forEach(element => {
            if (element.checked === false) {
                var categoryClass = "." + element.value;
                document.querySelector(categoryClass).style.display = "none";
            }
            element.addEventListener('click', (e) => {
                var categoryClass = "." + element.value;
                if (element.checked === false) {
                    document.querySelector(categoryClass).style.display = "none";
                } else {
                    document.querySelector(categoryClass).style.display = "inherit";
                }
            })
        });
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