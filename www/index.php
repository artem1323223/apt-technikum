<?php
echo "<h1>АПТ Техникум</h1>";
echo "<p>Сайт работает!</p>";
echo "<p>Время: " . date('Y-m-d H:i:s') . "</p>";

$host = getenv('MYSQLHOST');
$dbname = getenv('MYSQL_DATABASE');  // Добавьте эту строку
echo "<p>MYSQLHOST: " . ($host ?: 'не установлена') . "</p>";
echo "<p>MYSQL_DATABASE: " . ($dbname ?: 'не установлена') . "</p>";

if ($host && $dbname) {
    try {
        $pdo = new PDO(
            "mysql:host=" . getenv('MYSQLHOST') . ";port=" . getenv('MYSQLPORT') . ";dbname=" . getenv('MYSQL_DATABASE'),
            getenv('MYSQLUSER'),
            getenv('MYSQLPASSWORD')
        );
        echo "<p style='color:green'>✅ База данных подключена!</p>";
        
        // Проверяем таблицы
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "<h3>Таблицы в базе данных:</h3>";
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul>";
        
        // Проверяем пользователей
        $stmt = $pdo->query("SELECT COUNT(*) FROM users");
        $count = $stmt->fetchColumn();
        echo "<p>👥 Пользователей: " . $count . "</p>";
        
    } catch(Exception $e) {
        echo "<p style='color:red'>❌ Ошибка: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color:orange'>⚠️ Не хватает переменных окружения</p>";
}
?>
