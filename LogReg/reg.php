<?php
$host = '127.0.0.1';
$dbname = 'TimeShop'; 
$user = 'root';
$pass = 'MyNewPass123!';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $new_login    = $_POST["login"] ?? '';
    $new_password = $_POST["password"] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->execute(['login' => $new_login]);
    $isLog = $stmt->fetch(PDO::FETCH_ASSOC);
    if($isLog){
        echo 1;
        exit();
    }
    // add new user to sql
    $stmt = $pdo->prepare("INSERT INTO users (login, password, cash) VALUES (:login, :password, :cash)");
    $stmt->execute(['login' => $new_login, 'password' => $new_password, 'cash' => 0]);
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->execute(['login' => $new_login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo 0;
    setcookie("userID", $user['id'], time() + 2*3600, "/");
    exit();
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage(); // Покажет ошибку, если есть
    }
}
?>