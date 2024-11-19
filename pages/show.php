<?php
$pdo = new PDO("mysql:host=localhost;dbname=MySiteDB", "root", "");

$stmt = $pdo->query("SELECT * FROM Pictures");
$pictures = $stmt->fetchAll(PDO::FETCH_ASSOC);

$selectedImage = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['picture_id'])) {
    $id = $_POST['picture_id'];
    $stmt = $pdo->prepare("SELECT * FROM Pictures WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $selectedImage = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Просмотр изображений</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Просмотр изображений</h1>
    <form action="show.php" method="post">
        <select name="picture_id">
            <?php foreach ($pictures as $picture): ?>
                <option value="<?php echo $picture['id']; ?>">
                    <?php echo htmlspecialchars($picture['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Показать изображение</button>
    </form>

    <?php if ($selectedImage): ?>
        <h2>Изображение: <?php echo htmlspecialchars($selectedImage['name']); ?></h2>
        <p>Размер: <?php echo $selectedImage['size']; ?> байт</p>
        <img src="<?php echo htmlspecialchars($selectedImage['imagepath']); ?>" alt="<?php echo htmlspecialchars($selectedImage['name']); ?>">
    <?php endif; ?>

    <a href="../index.php">На главную</a>
</div>
</body>
</html>
