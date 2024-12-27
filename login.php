<?php

session_start();
require 'includes/db.php'; // Inclui o arquivo de conexão com o banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    echo $email . $password;

    if (!empty($email) && !empty($password)) {
        try {
            // Busca o usuário no banco pelo email
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            //if ($user && password_verify($password, $user['password'])) {
            if ($user && ($password == $user['password'])) {
                // Login bem-sucedido
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];

                header('Location: blog/layout.php'); // Redireciona para o dashboard
                exit();
            } else {
                $_SESSION['error'] = 'Email ou senha incorretos!';
                header('Location: index.php'); // Redireciona de volta ao login
                exit();
                
            }
        } catch (PDOException $e) {
            die("Erro no login: " . $e->getMessage());
        }
    } else {
        $_SESSION['error'] = 'Preencha todos os campos!';
        header('Location: index.php'); // Redireciona para a página de login
        exit();
    }
}

?>