<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> - Главная</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        /* УНИФИЦИРОВАННЫЙ КОНТЕЙНЕР ДЛЯ ВСЕХ СТРАНИЦ */
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .hero {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .hero h1 {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 2rem 0;
        }
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .feature-card:hover { transform: translateY(-5px); }
        .feature-card i {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 2rem 0;
        }
        .stat-card {
            background: white;
            padding: 1.5rem;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .stat-card h3 {
            font-size: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        footer {
            background: rgba(0,0,0,0.8);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
        }
        @media (max-width: 768px) {
            .page-container { padding: 20px 15px; }
            .stats { grid-template-columns: repeat(2, 1fr); }
            .hero h1 { font-size: 1.8rem; }
            .hero { padding: 2rem; }
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="page-container">
        <div class="hero">
            <h1>Добро пожаловать в АПТ Техникум</h1>
            <p style="font-size: 1.2rem;">Современное образование для будущих IT-специалистов</p>
        </div>

        <div class="features">
            <div class="feature-card">
                <i class="fas fa-code"></i>
                <h3>Современные технологии</h3>
                <p>Изучаем актуальные языки программирования</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-users"></i>
                <h3>Опытные преподаватели</h3>
                <p>Практикующие специалисты из IT-компаний</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-briefcase"></i>
                <h3>Трудоустройство</h3>
                <p>Помощь в трудоустройстве после обучения</p>
            </div>
        </div>

        <div class="stats">
            <div class="stat-card"><h3>500+</h3><p>Выпускников</p></div>
            <div class="stat-card"><h3>50+</h3><p>Партнеров</p></div>
            <div class="stat-card"><h3>100%</h3><p>Трудоустройство</p></div>
            <div class="stat-card"><h3>10+</h3><p>Лет опыта</p></div>
        </div>
    </div>

    <footer>
        <div class="page-container">
            <p>&copy; 2024 АПТ Техникум. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>
