<?php
    $pname = $_POST['name'];
    $pizza = $_POST['pizza'];
    $sauce = $_POST['sauce'];
    $extras = "";
    $delivery = $_POST['delivery'];
    
    for ($i = 0; $i < count($_POST['extras']) - 1; $i++) {
        $extras .= $_POST['extras'][$i];
        $extras .= ", ";
    }
    $extras .= $_POST['extras'][count($_POST['extras']) - 1];

   
    $HOST = 'localhost';
    $USERNAME = 'root';
    $PASSWORD = '';
    
   
    $conn = new mysqli($HOST, $USERNAME, $PASSWORD);

    
    $sql_db = "CREATE DATABASE IF NOT EXISTS pizza_order";

    if (mysqli_query($conn, $sql_db)) {
        $conn = mysqli_connect($HOST, $USERNAME, $PASSWORD, "pizza_order");
    }
    else {
        die("Unable to CREATE DATABASE " . $conn->connect_error);
    }

    
    $sql_table = "CREATE TABLE IF NOT EXISTS orders(
        id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        pizza_name TEXT,
        pizza TEXT,
        sauce TEXT,
        extras TEXT,
        delivery_instructions TEXT
    )";

 
    if (!mysqli_query($conn, $sql_table)) {
        $table = 1;
    };
    
   
    $sql_insert = "INSERT INTO `orders`(`pizza_name`, `pizza`, `sauce`, `extras`, `delivery_instructions`) 
    VALUES 
    ('$pname', '$pizza', '$sauce', '$extras', '$delivery')";

  
    if ($conn->query($sql_insert) === TRUE) {
       
        echo "<p>Your order has been registered successfully.Have a nice day</p>";
    } else {
        die("<p>You couldn't be registered </em></p><p>" . $conn->error . "</p>");
    }
?>