<?php
require 'includes/db.php';

$query = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h1>Blog</h1>
    <?php foreach ($posts as $post): ?>
    <article>
        <?php if ($post['image']): ?>
            <img src="assets/images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" style="max-width: 100%; height: auto;">
        <?php endif; ?>
        <h2><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
        <p>Publicado por <?= $post['author'] ?> em <?= date('d/m/Y', strtotime($post['created_at'])) ?></p>
        <p><?= substr($post['content'], 0, 150) ?>...</p>
    </article>
<?php endforeach; ?>
</body>
</html>
