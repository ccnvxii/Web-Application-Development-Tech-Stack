<?php
// Перевірка, чи була відправлена форма або запит на видалення
if (isset($_POST['username'])) {
    setcookie('user_name', $_POST['username'], time() + (86400 * 7), "/");
    header("Location: index.php"); // Перезавантаження для відображення змін
}

if (isset($_POST['delete_cookie'])) {
    setcookie('user_name', '', time() - 3600, "/"); // Встановлюємо час у минулому для видалення
    header("Location: index.php");
}

$name = $_COOKIE['user_name'] ?? null;
?>

<!DOCTYPE html>
<html lang="uk">
<body>
<?php if ($name): ?>
    <h1>Вітаємо знову, <?= htmlspecialchars($name) ?>!</h1>
    <form method="POST">
        <button type="submit" name="delete_cookie">Забути мене</button>
    </form>
<?php else: ?>
    <form method="POST">
        <label>Введіть ваше ім'я: </label>
        <input type="text" name="username" required>
        <button type="submit">Зберегти</button>
    </form>
<?php endif; ?>
</body>
</html>