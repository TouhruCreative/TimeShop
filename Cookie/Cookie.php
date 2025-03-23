<?php
$host = '127.0.0.1';
$dbname = 'TimeShop'; 
$user = 'root';
$pass = 'MyNewPass123!';

try {
    if(isset($_COOKIE["userID"])){
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id'=> $_COOKIE["userID"] ]);
        $cash = ($stmt->fetch(PDO::FETCH_ASSOC))['cash'];        
        header("Content-Type: application/json");
        echo json_encode($cash);
    } else{
        exit();
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Ошибка: " . $e->getMessage()]);
    exit();
}

// header("Content-Type: application/json");
// echo json_encode($products);
?>