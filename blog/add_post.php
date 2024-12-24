<?php
require '../includes/db.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    // Processar upload da imagem
    $image = null; // Variável para armazenar o nome da imagem
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $imagePath = "../assets/images/" . $imageName;

        // Verifica se o upload foi bem-sucedido
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $image = $imageName;
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    }

    // Inserir dados no banco de dados
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, author, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $content, $author, $image]);

    // Redirecionar para o dashboard
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Post</title>
</head>
<body>
    <h1>Adicionar Post</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Título" required>
        <textarea name="content" placeholder="Conteúdo" required></textarea>
        <input type="text" name="author" placeholder="Autor" required>
        <input type="file" name="image" accept="image/*">
        <button type="submit">Publicar</button>
    </form>
</body>
</html>
