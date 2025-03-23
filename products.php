<?php
$host = '127.0.0.1';
$dbname = 'TimeShop'; 
$user = 'root';
$pass = 'MyNewPass123!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем все товары из БД
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Исправлено

} catch (PDOException $e) {
    echo json_encode(["error" => "Ошибка: " . $e->getMessage()]);
    exit();
}

header("Content-Type: application/json");
echo json_encode($products);
?>