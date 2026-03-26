<?php
session_start();

$timeout = 300; // 5 хвилин у секундах

// Перевірка активності (Завдання 5)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: login.php?error=timeout");
    exit;
}
$_SESSION['last_activity'] = time();

// Логіка входу
if (isset($_POST['do_login'])) {
    if ($_POST['login'] === 'admin' && $_POST['pass'] === '1234') {
        $_SESSION['user'] = 'Адміністратор';
    }
}

// Логіка виходу
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<body>
<?php if (isset($_SESSION['user'])): ?>
    <h2>Вітаємо, <?= $_SESSION['user'] ?>! Ви увійшли через Сесію.</h2>
    <p>Ваша сесія активна. Якщо не оновлювати сторінку 5 хв, вона закриється.</p>
    <a href="?logout=1">Вийти</a>
<?php else: ?>
    <form method="POST">
        <input type="text" name="login" placeholder="Логін (admin)" required><br>
        <input type="password" name="pass" placeholder="Пароль (1234)" required><br>
        <button type="submit" name="do_login">Увійти</button>
    </form>
    <?php if(isset($_GET['error'])) echo "<p style='color:red;'>Сесія вичерпана за неактивність.</p>"; ?>
<?php endif; ?>
</body>
</html>