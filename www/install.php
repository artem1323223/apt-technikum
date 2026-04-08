<?php
echo "<h1>Установка базы данных</h1>";

$host = getenv('MYSQLHOST');
$dbname = getenv('MYSQL_DATABASE');
$user = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Создание таблицы users
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        full_name VARCHAR(100) NOT NULL,
        phone VARCHAR(20),
        user_role ENUM('user', 'admin') DEFAULT 'user',
        is_active BOOLEAN DEFAULT TRUE,
        last_login TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "<p style='color:green'>✅ Таблица users создана</p>";
    
    // Создание таблицы students
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(20) NOT NULL UNIQUE,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone VARCHAR(20),
        birth_date DATE,
        address TEXT,
        group_name VARCHAR(50) NOT NULL,
        course INT DEFAULT 1,
        specialty VARCHAR(100) NOT NULL,
        photo VARCHAR(255) DEFAULT 'default_student.jpg',
        enrollment_year YEAR,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "<p style='color:green'>✅ Таблица students создана</p>";
    
    // Создание таблицы teachers
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS teachers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        teacher_id VARCHAR(20) NOT NULL UNIQUE,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone VARCHAR(20),
        birth_date DATE,
        address TEXT,
        position VARCHAR(100) NOT NULL,
        department VARCHAR(100) NOT NULL,
        degree VARCHAR(100),
        experience_years INT DEFAULT 0,
        photo VARCHAR(255) DEFAULT 'default_teacher.jpg',
        specialization TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "<p style='color:green'>✅ Таблица teachers создана</p>";
    
    // Создание таблицы messages
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        subject VARCHAR(200) NOT NULL,
        message TEXT NOT NULL,
        priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
        status ENUM('new', 'read', 'replied') DEFAULT 'new',
        admin_reply TEXT,
        replied_by INT,
        replied_at TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "<p style='color:green'>✅ Таблица messages создана</p>";
    
    // Добавление администратора
    $stmt = $pdo->prepare("INSERT IGNORE INTO users (username, email, password, full_name, user_role) VALUES ('admin', 'admin@apt.ru', MD5('admin123'), 'Администратор', 'admin')");
    $stmt->execute();
    echo "<p style='color:green'>✅ Администратор создан (login: admin, password: admin123)</p>";
    
    echo "<h2 style='color:green'>✅ Установка завершена!</h2>";
    echo "<p><a href='/'>Перейти на сайт</a></p>";
    
} catch(Exception $e) {
    echo "<p style='color:red'>❌ Ошибка: " . $e->getMessage() . "</p>";
}
?>
