<?php
require 'includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('Post não encontrado.');
}

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die('Post não encontrado.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $post['title'] ?></title>
</head>
<body>
    <h1><?= $post['title'] ?></h1>
    <p>Publicado por <?= $post['author'] ?> em <?= date('d/m/Y', strtotime($post['created_at'])) ?></p>
    <p><?= $post['content'] ?></p>
    <?php if ($post['image']): ?>
    <img src="assets/images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" style="max-width: 100%; height: auto;">
<?php endif; ?>

</body>
</html>
