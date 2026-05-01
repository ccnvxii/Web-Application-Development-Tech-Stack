<?php
$host = 'localhost';
$db   = 'users_db';
$user = 'root'; // стандартний користувач XAMPP/OpenServer
$pass = '';     // стандартний пароль (зазвичай порожній)
$charset = 'utf8mb4';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Помилка підключення: " . $mysqli->connect_error);
}
?>