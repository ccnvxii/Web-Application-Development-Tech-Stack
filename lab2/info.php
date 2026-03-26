<?php
// Автоматичне перенаправлення, якщо метод не POST (Завдання 3)
// Для демонстрації можна закоментувати, щоб побачити вивід даних через GET
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // header("Location: error.php");
    echo "<i>Попередження: Метод запиту не POST (зараз " . $_SERVER['REQUEST_METHOD'] . ").</i><hr>";
}
?>

<h3>Інформація про сервер та клієнта:</h3>
<ul>
    <li><b>IP-адреса:</b> <?= $_SERVER['REMOTE_ADDR'] ?></li>
    <li><b>Браузер:</b> <?= $_SERVER['HTTP_USER_AGENT'] ?></li>
    <li><b>Назва скрипта:</b> <?= $_SERVER['PHP_SELF'] ?></li>
    <li><b>Метод запиту:</b> <?= $_SERVER['REQUEST_METHOD'] ?></li>
    <li><b>Шлях до файлу:</b> <?= $_SERVER['SCRIPT_FILENAME'] ?></li>
</ul>