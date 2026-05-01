<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Перевірка хешованого пароля
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: Welcome.php");
            exit();
        } else {
            echo "Невірний пароль!";
        }
    } else {
        echo "Користувача не знайдено!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вхід</title>
</head>
<body>
<h2>Форма авторизації</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Ім'я користувача" required><br><br>
    <input type="password" name="password" placeholder="Пароль" required><br><br>
    <button type="submit">Увійти</button>
</form>
</body>
</html>