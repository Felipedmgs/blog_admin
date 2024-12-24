<?php
require '../includes/db.php';

// Verificar se o usuário está autenticado (implementar autenticação futuramente)

// Buscar todos os posts
$query = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Painel Administrativo</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Painel Administrativo</h1>
    <a href="add_post.php">Adicionar Novo Post</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $post['id'] ?></td>
                    <td><?= $post['title'] ?></td>
                    <td><?= $post['author'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></td>
                    <td>
                        <a href="edit_post.php?id=<?= $post['id'] ?>">Editar</a> | 
                        <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este post?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
