<?php
// --- 1. Створення базового PHP-скрипта ---
echo "Hello, World!<br><br>";

// --- 2. Змінні та типи даних ---
$name = "Олексій";       // String
$age = 20;               // Integer
$rating = 4.8;           // Float
$isStudent = true;       // Bool

echo "Ім'я: $name, Вік: $age, Рейтинг: $rating, Студент: " . ($isStudent ? "Так" : "Ні") . "<br>";

// Виведення типів змінних
var_dump($name); echo "<br>";
var_dump($age); echo "<br>";
var_dump($rating); echo "<br>";
var_dump($isStudent); echo "<br><br>";

// --- 3. Конкатенація рядків ---
$part1 = "Перший рядок";
$part2 = "Другий рядок";
$fullSentence = $part1 . $part2; // Об'єднання через крапку
echo $fullSentence . "<br><br>";

// --- 4. Умовні конструкції ---
$number = 15;
if ($number % 2 == 0) {
    echo "Число $number є парним.<br><br>";
} else {
    echo "Число $number є непарним.<br><br>";
}

// --- 5. Цикли ---
echo "Цикл for (1 до 10): ";
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br>";

echo "Цикл while (10 до 1): ";
$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "<br><br>";

// --- 6. Масиви ---
$student = [
    "first_name" => "Максим",
    "last_name" => "Петренко",
    "age" => 19,
    "specialty" => "Інженерія програмного забезпечення"
];

echo "Дані студента: " . $student["first_name"] . " " . $student["last_name"] . ", Спеціальність: " . $student["specialty"] . "<br>";

// Додавання нового елемента
$student["average_score"] = 92.5;

echo "Оновлений масив: <pre>";
print_r($student);
echo "</pre>";
?>