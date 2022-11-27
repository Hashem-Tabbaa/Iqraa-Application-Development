<?php
    session_start();
    // var_dump($_SESSION);
    if(!isset($_SESSION["UserType"]) || $_SESSION["UserType"] != "admin"){
        header("location: ./index.php");
        var_dump($_SESSION);
        exit;
    }
    include("./adminHeader.php");

    require "php/connection.php";
    $pdo = db::getInstance();
    $sql = "SELECT * FROM orders INNER JOIN book on orders.book_id = book.book_id 
    INNER JOIN refugee on refugee.refugee_id = orders.refugee_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll();
    $orders_grouped_by_refugee_id = [];
    foreach($orders as $order){
        if(!isset($orders_grouped_by_refugee_id[$order["refugee_id"]])){
            $orders_grouped_by_refugee_id[$order["refugee_id"]] = [];
        }
        array_push($orders_grouped_by_refugee_id[$order["refugee_id"]], $order);
    }
    // var_dump($orders_grouped_by_refugee_id);
    //print refugees and thier orders
    echo "<table class='table table-striped'>";
    echo "
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Resident Number</th>
            <th>Camp</th>
            <th>ID</th>
            <th>Phone Number</th>
            <th>Order</th>
            <th>Order Date</th>
            <th>Confirm</th>    
        </tr>
    </thead>
    <tbody>";
    foreach($orders_grouped_by_refugee_id as $refugee_id => $orders){
        echo"
        <tr>
            <td>".$orders[0]["first_name"]."</td>
            <td>".$orders[0]["last_name"]."</td>
            <td>".$orders[0]["resident_number"]."</td>
            <td>".$orders[0]["refugee_camp"]."</td>
            <td>".$orders[0]["refugee_id"]."</td>
            <td>".$orders[0]["phone_number"]."</td>";
        echo "<td>";
        foreach($orders as $order){
            echo $order["name"]." ( ".$order["days"]." days )<br>";
        }
        echo "</td>";
        echo "<td>".$orders[0]["order_date"]."</td>";
        echo "<td>";
        echo'
        <form action="php/confirmOrder.php" method="POST">
            <input type="hidden" name="refugee_id" value="'.$refugee_id.'">
            <input type="submit" class = "btn-primary btn">
        </form>';
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
?>
<?php
    include("./footer.php")
?>