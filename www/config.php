<?php
session_start();

// Настройки базы данных (для Railway используем переменные окружения)
$db_host = getenv('MYSQLHOST') ?: 'mysql.railway.internal';
$db_port = getenv('MYSQLPORT') ?: '3306';
$db_name = getenv('MYSQLDATABASE') ?: 'railway';
$db_user = getenv('MYSQLUSER') ?: 'root';
$db_password = getenv('MYSQLPASSWORD') ?: getenv('MYSQL_ROOT_PASSWORD') ?: '';

// Для локальной разработки
if (empty($db_password)) {
    $db_host = 'mysql';
    $db_name = 'apt_db';
    $db_user = 'apt_user';
    $db_password = 'apt123';
}

define('DB_HOST', $db_host);
define('DB_PORT', $db_port);
define('DB_NAME', $db_name);
define('DB_USER', $db_user);
define('DB_PASSWORD', $db_password);
define('SITE_NAME', 'АПТ Техникум');
define('SITE_URL', getenv('RAILWAY_PUBLIC_DOMAIN') ? 'https://' . getenv('RAILWAY_PUBLIC_DOMAIN') : 'http://localhost:8080');
define('UPLOAD_DIR', __DIR__ . '/uploads/');

// Установка кодировки
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');

// Функция подключения к БД
function getDBConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ));
            $pdo->exec("SET NAMES utf8mb4");
        } catch(PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
    return $pdo;
}

// Функция проверки авторизации
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Функция получения текущего пользователя
function getCurrentUser() {
    if (!isLoggedIn()) return null;
    
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

// Функция проверки роли
function isAdmin() {
    $user = getCurrentUser();
    return $user && $user['user_role'] === 'admin';
}

// Функция для безопасного вывода
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
