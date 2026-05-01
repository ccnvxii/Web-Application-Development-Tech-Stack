<?php
session_start();

// Перевірка, чи користувач авторизований
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вітаємо</title>
</head>
<body>
<h1>Ласкаво просимо, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<p>Це захищена сторінка, доступна тільки після входу.</p>
<a href="logout.php">Вийти</a>
</body>
</html>