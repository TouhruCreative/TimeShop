<?php
$host = '127.0.0.1';
$dbname = 'TimeShop'; 
$user = 'root';
$pass = 'MyNewPass123!';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $login    = $_POST["login"] ?? '';
    $password = $_POST["password"] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo 1; // Пользователь не найден
        exit();
    }
    if ($password!=$user['password']){
        echo 2;
        exit();
    }
    echo 0;
    setcookie("userID", $user['id'], time() + 2*3600, "/");
    exit();
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage(); // Покажет ошибку, если есть
    }
}
?>