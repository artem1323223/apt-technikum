<?php
echo "<h1>Тест подключения к базе данных</h1>";

// Показываем переменные окружения
echo "<h2>Переменные окружения:</h2>";
echo "<pre>";
echo "MYSQLHOST: " . (getenv('MYSQLHOST') ?: 'не установлена') . "\n";
echo "MYSQLPORT: " . (getenv('MYSQLPORT') ?: 'не установлена') . "\n";
echo "MYSQLDATABASE: " . (getenv('MYSQLDATABASE') ?: 'не установлена') . "\n";
echo "MYSQLUSER: " . (getenv('MYSQLUSER') ?: 'не установлена') . "\n";
echo "MYSQLPASSWORD: " . (getenv('MYSQLPASSWORD') ? 'установлена' : 'не установлена') . "\n";
echo "</pre>";

// Подключаемся к БД
try {
    $host = getenv('MYSQLHOST') ?: 'mysql.railway.internal';
    $port = getenv('MYSQLPORT') ?: '3306';
    $dbname = getenv('MYSQLDATABASE') ?: 'railway';
    $user = getenv('MYSQLUSER') ?: 'root';
    $password = getenv('MYSQLPASSWORD') ?: '';
    
    echo "<h2>Параметры подключения:</h2>";
    echo "<p>Хост: $host</p>";
    echo "<p>Порт: $port</p>";
    echo "<p>База: $dbname</p>";
    echo "<p>Пользователь: $user</p>";
    
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2 style='color:green'>✅ Подключение успешно!</h2>";
    
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
    $usersCount = $stmt->fetchColumn();
    echo "<p>👥 Количество пользователей: $usersCount</p>";
    
    // Проверяем студентов
    $stmt = $pdo->query("SELECT COUNT(*) FROM students");
    $studentsCount = $stmt->fetchColumn();
    echo "<p>👨‍🎓 Количество студентов: $studentsCount</p>";
    
    // Проверяем преподавателей
    $stmt = $pdo->query("SELECT COUNT(*) FROM teachers");
    $teachersCount = $stmt->fetchColumn();
    echo "<p>👨‍🏫 Количество преподавателей: $teachersCount</p>";
    
} catch(PDOException $e) {
    echo "<h2 style='color:red'>❌ Ошибка подключения!</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
