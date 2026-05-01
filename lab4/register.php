<?php

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    // Хешування пароля
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Підготовлений запит
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Реєстрація успішна! <a href='login.php'>Увійти</a>";
    } else {
        echo "Помилка: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Реєстрація</title>
</head>
<body>
<h2>Форма реєстрації</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Ім'я користувача" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Пароль" required><br><br>
    <button type="submit">Зареєструватися</button>
</form>
<p>Вже маєте акаунт? <a href="login.php">Увійти</a></p>
</body>
</html>