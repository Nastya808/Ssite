<?php
$pdo = new PDO("mysql:host=localhost;dbname=MySiteDB", "root", "");

$stmt = $pdo->query("SELECT COUNT(*) FROM Pictures");
$count = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Загрузка файлов на сервер</h1>
    <p>Количество изображений в базе данных: <?php echo $count; ?></p>
    <a href="pages/upload.php">Загрузить изображение</a>
    <a href="pages/show.php">Просмотреть изображения</a>
</div>
</body>
</html>
