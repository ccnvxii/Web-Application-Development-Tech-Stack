<?php
// Перевіряємо, чи дані були надіслані методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Отримуємо дані та очищуємо
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);

    // Перевірка на пусті значення
    if (empty($firstName) || empty($lastName)) {
        echo "Помилка: Всі поля мають бути заповнені!";
    }
    // Перевірка типу даних - не цифри
    elseif (is_numeric($firstName) || is_numeric($lastName)) {
        echo "Помилка: Ім'я та прізвище не можуть бути просто числами!";
    }
    else {
        // Виведення привітання
        echo "<h1>Вітаємо, " . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "!</h1>";
        echo "<p>Ваші дані успішно оброблені.</p>";
    }
} else {
    echo "Будь ласка, скористайтеся формою для вводу даних.";
}

echo '<br><a href="index.html">Повернутися назад</a>';
?>