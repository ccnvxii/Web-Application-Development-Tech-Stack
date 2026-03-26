<?php
session_start();

// Додавання товару
if (isset($_POST['add_item'])) {
    $item = htmlspecialchars($_POST['item']);

    // Зберігаємо в поточну сесію
    $_SESSION['cart'][] = $item;

    // Оновлюємо історію в Cookie (зберігаємо масив як JSON)
    $history = isset($_COOKIE['past_items']) ? json_decode($_COOKIE['past_items'], true) : [];
    if (!in_array($item, $history)) {
        $history[] = $item;
        setcookie('past_items', json_encode($history), time() + (86400 * 30), "/");
    }
}

$currentItems = $_SESSION['cart'] ?? [];
$pastItems = isset($_COOKIE['past_items']) ? json_decode($_COOKIE['past_items'], true) : [];
?>

<!DOCTYPE html>
<html lang="uk">
<body>
<h2>Корзина покупок</h2>
<form method="POST">
    <input type="text" name="item" placeholder="Назва товару" required>
    <button type="submit" name="add_item">Додати</button>
</form>

<h3>Зараз у кошику (Session):</h3>
<ul>
    <?php foreach ($currentItems as $i) echo "<li>$i</li>"; ?>
</ul>

<h3>Ви раніше цікавилися (Cookie):</h3>
<ul>
    <?php foreach ($pastItems as $p) echo "<li>$p</li>"; ?>
</ul>
</body>
</html>