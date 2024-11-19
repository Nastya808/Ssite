<?php
$pdo = new PDO("mysql:host=localhost;dbname=MySiteDB", "root", "");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $imageName = basename($image['name']);
    $imageSize = $image['size'];
    $imagePath = "../images/" . $imageName;

    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        $stmt = $pdo->prepare("INSERT INTO Pictures (name, size, imagepath) VALUES (:name, :size, :path)");
        $stmt->execute([':name' => $imageName, ':size' => $imageSize, ':path' => $imagePath]);
        echo "<p>Изображение успешно загружено!</p>";
    } else {
        echo "<p>Ошибка при загрузке изображения.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузить изображение</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Загрузить изображение</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <button type="submit">Загрузить</button>
    </form>
    <a href="../index.php">На главную</a>
</div>
</body>
</html>
