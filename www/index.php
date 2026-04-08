<?php
echo "<h1>АПТ Техникум</h1>";
echo "<p>Сайт работает!</p>";
echo "<p>Время: " . date('Y-m-d H:i:s') . "</p>";

// Проверка переменных окружения
$host = getenv('MYSQLHOST');
echo "<p>MYSQLHOST: " . ($host ?: 'не установлена') . "</p>";

if ($host) {
    try {
        $pdo = new PDO(
            "mysql:host=" . getenv('MYSQLHOST') . ";port=" . getenv('MYSQLPORT') . ";dbname=" . getenv('MYSQLDATABASE'),
            getenv('MYSQLUSER'),
            getenv('MYSQLPASSWORD')
        );
        echo "<p style='color:green'>✅ База данных подключена!</p>";
        
        $stmt = $pdo->query("SELECT COUNT(*) FROM users");
        $count = $stmt->fetchColumn();
        echo "<p>👥 Пользователей: " . $count . "</p>";
        
    } catch(Exception $e) {
        echo "<p style='color:red'>❌ Ошибка: " . $e->getMessage() . "</p>";
    }
}
?>
