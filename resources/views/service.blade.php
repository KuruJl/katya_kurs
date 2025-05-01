<!DOCTYPE html>
<html lang="ru"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nails.iirk - Услуги</title> <link rel="stylesheet" href="https://fonts.fontstorage.com/import/kyivtypeserif.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* Сброс стилей и базовые настройки */
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            width: 100%;
            font-family: 'Inter', sans-serif; /* Задаем Inter как базовый шрифт */
            background-color: #feceda; /* Фон для всей страницы */
            color: #333; /* Базовый цвет текста, если не переопределен */
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        .salon-container {
            max-width: 1320px; /* Уменьшил max-width для лучшего вида на не самых широких экранах */
            margin: 0 auto;
            padding: 50px 40px; /* Уменьшил паддинги */
            /* background-color: #feceda; Убрано, так как задано для body */
        }
        @media (max-width: 991px) {
            .salon-container {
                /* max-width: 991px; Убрано, не нужно */
                padding: 40px 20px;
            }
        }
        @media (max-width: 640px) {
            .salon-container {
                /* max-width: 640px; Убрано, не нужно */
                padding: 30px 15px;
            }
        }

        .header {
            display: flex;
            align-items: center;
            gap: 25px; /* Немного увеличил */
            margin-bottom: 60px; /* Увеличил отступ */
            flex-wrap: wrap; /* Позволит перенос, если не помещается */
            justify-content: center; /* Центрируем на случай переноса */
        }
        @media (max-width: 768px) { /* Раньше переключаем на колонку */
            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
                margin-bottom: 40px;
            }
        }

        .logo {
            width: 150px; /* Уменьшил */
            height: 150px; /* Уменьшил */
            border-radius: 20px;
            object-fit: cover; /* Добавил на случай неквадратного лого */
            flex-shrink: 0; /* Чтобы лого не сжималось */
        }
        @media (max-width: 640px) {
             .logo {
                 width: 120px;
                 height: 120px;
             }
        }

        .salon-info {
            display: flex;
            flex-direction: column;
            align-items: center; /* На мобильных уже отцентрировано через .header */
            text-align: center; /* Добавил для мобильных */
        }
        @media (min-width: 769px) { /* На больших экранах выравнивание по левому краю */
            .salon-info {
                 align-items: flex-start;
                 text-align: left;
             }
        }


        .salon-name {
            color: #881d3a;
            letter-spacing: 8px; /* Уменьшил */
            margin-bottom: 10px;
            font-size: 56px; /* Немного уменьшил */
            font-weight: 600; /* Используем Inter Bold */
            font-family: 'Inter', sans-serif; /* Явно указываем Inter */
        }
        @media (max-width: 991px) {
            .salon-name {
                font-size: 44px;
            }
        }
        @media (max-width: 640px) {
            .salon-name {
                font-size: 32px;
                letter-spacing: 5px;
            }
        }

        .salon-address {
            color: #a73151;
            letter-spacing: 4px; /* Уменьшил */
            font-size: 28px; /* Уменьшил */
             font-family: 'Inter', sans-serif; /* Явно указываем Inter */
        }
        @media (max-width: 991px) {
            .salon-address {
                font-size: 22px;
            }
        }
        @media (max-width: 640px) {
            .salon-address {
                font-size: 18px;
                letter-spacing: 3px;
            }
        }

        .services-container {
            display: flex;
            flex-direction: column;
            gap: 40px; /* Уменьшил */
        }

        .service-item {
            display: flex;
            align-items: center;
            gap: 60px; /* Уменьшил */
             /* font-family: 'Kyiv Type Serif'; Убрано отсюда, применяем ниже */
        }
        @media (max-width: 991px) {
            .service-item {
                flex-direction: column;
                gap: 30px;
                align-items: center;
                text-align: center; /* Центрируем текст под картинкой */
            }
        }

        .service-image {
             /* width: 629px; Убрано, используем flex/max-width */
             /* height: 566px; Убрано */
             max-width: 50%; /* Занимает половину ширины */
             width: 100%; /* Для корректной работы max-width */
             height: auto; /* Автоматическая высота */
             aspect-ratio: 629 / 566; /* Сохраняем пропорции */
             border-radius: 20px;
             object-fit: cover;
             flex-shrink: 0; /* Чтобы картинка не сжималась сильнее текста */
        }
        @media (max-width: 991px) {
            .service-image {
                max-width: 100%; /* На мобильных занимает всю ширину */
                aspect-ratio: 16 / 10; /* Можно задать другое соотношение для моб */
            }
        }

        .service-details {
            display: flex;
            flex-direction: column;
            align-items: center; /* Центрируем текст */
            gap: 15px; /* Уменьшил */
            font-family: 'Kyiv Type Serif', serif; /* <--- ПРИМЕНЯЕМ ШРИФТ ЗДЕСЬ */
            flex-grow: 1; /* Позволяет блоку занять оставшееся место */
        }
         @media (min-width: 992px) { /* На больших экранах выравнивание по левому краю */
             .service-details {
                 align-items: flex-start;
             }
         }
        @media (max-width: 991px) {
            .service-details {
                width: 100%; /* Занимает всю ширину под картинкой */
            }
        }

        .service-name {
            color: #a73151;
            font-size: 48px; /* Уменьшил */
            /* font-family: 'Kyiv Type Serif'; Наследуется от .service-details */
            font-weight: normal; /* Убрал жирность, если не нужна от font */
        }
        @media (max-width: 991px) {
            .service-name {
                font-size: 32px;
            }
        }
        @media (max-width: 640px) {
            .service-name {
                font-size: 26px;
            }
        }

        .service-duration {
            color: #a73151;
            font-size: 32px; /* Уменьшил */
            /* font-family: 'Kyiv Type Serif'; Наследуется от .service-details */
            font-weight: normal;
        }
        @media (max-width: 991px) {
            .service-duration {
                font-size: 22px;
            }
        }
        @media (max-width: 640px) {
            .service-duration {
                font-size: 18px;
            }
        }

        .service-divider {
            height: 1px;
            margin: 40px 0; /* Уменьшил */
            background-color: #a73151;
            border: none; /* Убираем рамку у hr */
            width: 100%; /* Растягиваем на всю ширину */
        }

        .footer {
            display: flex;
            align-items: flex-start; /* Лого и контакты по верху */
            justify-content: space-between; /* Распределяем по краям */
            gap: 40px; /* Отступ между элементами */
            margin-top: 80px; /* Уменьшил */
            flex-wrap: wrap; /* Разрешаем перенос */
        }
        @media (max-width: 768px) { /* Раньше переключаем на колонку */
            .footer {
                flex-direction: column;
                align-items: center;
                gap: 30px;
                text-align: center;
                margin-top: 50px;
            }
        }

        .footer .logo { /* Стили для лого в футере */
            width: 100px;
            height: 100px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end; /* Выравниваем по правому краю */
        }
        @media (max-width: 768px) {
            .contact-info {
                align-items: center; /* На мобильных центрируем */
            }
        }

        .contact-phone {
            color: #a73151;
            letter-spacing: 3px; /* Уменьшил */
            margin-bottom: 20px; /* Уменьшил */
            font-size: 22px; /* Уменьшил */
             font-family: 'Inter', sans-serif; /* Явно указываем Inter */
        }
        @media (max-width: 640px) {
            .contact-phone {
                font-size: 18px;
            }
        }

        .social-links {
            display: flex;
            flex-direction: column;
            align-items: flex-end; /* Выравниваем по правому краю */
            gap: 15px; /* Уменьшил */
        }
        @media (max-width: 768px) {
            .social-links {
                align-items: center; /* На мобильных центрируем */
            }
        }

        .social-link {
            color: #a73151;
            letter-spacing: 3px; /* Уменьшил */
            font-size: 20px; /* Уменьшил */
            font-family: 'Inter', sans-serif; /* Явно указываем Inter */
            text-decoration: none; /* Убираем подчеркивание */
            transition: color 0.3s ease; /* Плавный ховер */
        }
        .social-link:hover {
            color: #881d3a; /* Цвет при наведении */
        }
        @media (max-width: 640px) {
            .social-link {
                font-size: 16px;
            }
        }

        /* Класс визуально скрытого контента */
        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
        .button {
            display: block; /* Занимает всю доступную ширину по умолчанию */
            width: 100%; /* Важно для блочного элемента в flex-контейнере */
            max-width: 600px; /* Максимальная ширина кнопки */
            padding: 15px 20px; /* Внутренние отступы */
            border-radius: 15px;
            background-color: #da6886;
            color: #fff;
            text-decoration: none; /* Убираем подчеркивание у ссылок */
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 20px;
            letter-spacing: 5px;
            text-transform: uppercase; /* Можно сделать заглавными буквами */
            text-align: center;
            transition: background-color 0.3s ease;
            box-sizing: border-box;
        }

    </style>
</head>
<body>

<div class="salon-container">
    <header class="header">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2166173af264b6b233ee79ec2f0ed8858f630d0c" alt="Логотип Nails.iirk" class="logo">
        <div class="salon-info">
            <h1 class="salon-name">Nails.iirk</h1>
            <p class="salon-address">ул. Розы Люксембург 227, подъезд 2</p>
        </div>
    </header>

    <main class="services-container">
        <section class="service-item">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/11881d13943e42960b27ad4d181ada9f923496b4" alt="Наращивание ногтей" class="service-image">
            <div class="service-details">
                <h2 class="service-name">Наращивание 2100Р</h2>
                <p class="service-duration">2 часа 30 минут</p>
                @auth
            <a href="{{ route('bookings.index') }}" class="button">Записаться онлайн</a>
        @else
            <a href="{{ route('register') }}" class="button">Записаться онлайн</a>
        @endauth       
        <a href="{{ route('main') }}" class="button">На главную </a>

            </div>
            
        </section>

        <hr class="service-divider"> <section class="service-item">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ed88e645342152f08776ddc6f716b94523dfd7e1" alt="Коррекция ногтей" class="service-image">
            <div class="service-details">
                <h2 class="service-name">Коррекция 2000Р</h2>
                <p class="service-duration">2 часа</p>
                @auth
            <a href="{{ route('bookings.index') }}" class="button">Записаться онлайн</a>
        @else
            <a href="{{ route('register') }}" class="button">Записаться онлайн</a>
        @endauth  
        <a href="{{ route('main') }}" class="button">На главную </a>

            </div>
        </section>

        <hr class="service-divider"> <section class="service-item">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e79ff66fb3aceebf7824d03cb406f7df170906af" alt="Укрепление ногтей" class="service-image">
            <div class="service-details">
                <h2 class="service-name">Укрепление 1500Р</h2>
                <p class="service-duration">1 час 30 мин</p>
                @auth
            <a href="{{ route('bookings.index') }}" class="button">Записаться онлайн</a>
        @else
            <a href="{{ route('register') }}" class="button">Записаться онлайн</a>
        @endauth  
        <a href="{{ route('main') }}" class="button">На главную </a>

            </div>
        </section>
    </main>

    <hr class="service-divider"> <footer class="footer">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2166173af264b6b233ee79ec2f0ed8858f630d0c" alt="Логотип Nails.iirk" class="logo">
        <div class="contact-info">
            <p class="contact-phone">Связаться с нами: 89025497599</p>
            <nav class="social-links">
                <a href="#" class="social-link">Наш VK</a>
                <a href="#" class="social-link">Наш Instagram</a> </nav>
        </div>
    </footer>
</div>
</body>
</html>