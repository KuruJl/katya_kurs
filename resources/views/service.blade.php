<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nails.iirk - Услуги</title>
    <link rel="stylesheet" href="https://fonts.fontstorage.com/import/kyivtypeserif.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        /* Сброс стилей и базовые настройки */
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            width: 100%;
            font-family: 'Montserrat', sans-serif;
            background-color: #feceda;
            color: #333;
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        .salon-container {
            max-width: 1200px;
            margin: 0 auto; /* Центрирование основного контейнера */
            padding: 40px 30px;
        }

        @media (max-width: 991px) {
            .salon-container {
                padding: 30px 20px;
            }
        }

        @media (max-width: 640px) {
            .salon-container {
                padding: 20px 10px;
            }
        }

        .header-container {
        max-width: 800px; /* Ширина контейнера форм */
        margin: 0 auto; /* Центрирование контейнера */
        margin-bottom: 30px; /* Отступ до основного контента */
        }

    .header-nav {
        margin-top: 20px;

        background-color: #da6886;
        color:rgb(255, 255, 255); /* Основной цвет текста шапки */
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(167, 49, 81, 0.1);
    }

    .brand-container {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
    }

    .logo {
        width: 80px;
        height: auto;
        border-radius: 10px;
        object-fit: contain;
        object-position: center;
    }

    .brand-name {
        color:rgb(255, 255, 255);
        letter-spacing: 4px;
        font-size: 24px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .brand-quality,
    .brand-elegance {
        letter-spacing: 3px;
        color:rgb(255, 255, 255);
        display: block;
        margin-top: 3px;
        font-size: 16px;
    }

    .nav-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .nav-button {
        padding: 10px 18px;
        background-color:#a73151;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 500;
        letter-spacing: 1px;
        transition: background-color 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .nav-button:hover {
        background-color: #c95a77;
    }

    .nav-button.profile {
        background-color: #a73151;
    }

    .nav-button.logout {
        background-color: #a73151;
    }

        .salon-info {
            display: flex;
            flex-direction: column;
            align-items: center; /* <-- ИЗМЕНЕНО: Всегда центрируем элементы внутри */
            text-align: center; /* <-- ИЗМЕНЕНО: Всегда центрируем текст */
        }

        /* УДАЛЕНО: Медиа-запрос для выравнивания по левому краю на больших экранах */
        /*
        @media (min-width: 769px) {
            .salon-info {
                align-items: flex-start;
                text-align: left;
            }
        }
        */

        .salon-name {
            color: #881d3a;
            letter-spacing: 6px;
            margin-bottom: 8px;
            font-size: 40px;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
        }

        @media (max-width: 991px) {
            .salon-name {
                font-size: 32px;
            }
        }

        @media (max-width: 640px) {
            .salon-name {
                font-size: 24px;
                letter-spacing: 4px;
            }
        }

        .salon-address {
            color: #a73151;
            letter-spacing: 3px;
            font-size: 20px;
            font-family: 'Montserrat', sans-serif;
        }

        @media (max-width: 991px) {
            .salon-address {
                font-size: 16px;
            }
        }

        @media (max-width: 640px) {
            .salon-address {
                font-size: 14px;
                letter-spacing: 2px;
            }
        }

        .services-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
            align-items: center; /* <-- Уже было: Центрируем дочерние элементы */
        }

        .service-item {
            display: flex;
            align-items: center;
            gap: 40px;
            max-width: 800px; /* <-- Уже было: Максимальная ширина блока услуги */
            width: 100%;      /* <-- Уже было: Блок услуги будет занимать 100% до max-width */
        }

        @media (max-width: 991px) {
            .service-item {
                flex-direction: column;
                gap: 20px;
                align-items: center;
                text-align: center;
            }
        }

        .service-image {
            max-width: 40%;
            width: 100%;
            height: auto;
            aspect-ratio: 629 / 566;
            border-radius: 15px;
            object-fit: cover;
            flex-shrink: 0;
        }

        @media (max-width: 991px) {
            .service-image {
                max-width: 100%;
                aspect-ratio: 16 / 10;
            }
        }
         @media (max-width: 600px) { /* Чтобы картинка не была слишком большой на узких экранах */
             .service-image {
                 max-width: 350px; /* Или другое значение */
             }
         }

        .service-details {
            display: flex;
            flex-direction: column;
            align-items: center; /* <-- ИЗМЕНЕНО: Всегда центрируем элементы внутри details (для кнопок, текста) */
            gap: 10px;
            font-family: 'Kyiv Type Serif', serif;
            flex-grow: 1;
            text-align: center; /* <-- НОВОЕ: Центрируем текст внутри details */
        }

        /* УДАЛЕНО: Медиа-запрос для выравнивания по левому краю на больших экранах */
        /*
        @media (min-width: 992px) {
            .service-details {
                align-items: flex-start;
            }
        }
        */
        @media (max-width: 991px) {
            .service-details {
                width: 100%; /* Под картинкой занимает всю ширину (внутри service-item) */
            }
        }

        .service-name {
            font-family: 'Montserrat';
            color: #a73151;
            font-size: 32px;
            font-weight: normal;
        }

        @media (max-width: 991px) {
            .service-name {
                font-size: 24px;
            }
        }

        @media (max-width: 640px) {
            .service-name {
                font-size: 20px;
            }
        }

        .service-duration {
            color: #a73151;
            font-size: 24px;
            font-weight: normal;
            font-family: 'Montserrat', sans-serif;
        }

        @media (max-width: 991px) {
            .service-duration {
                font-size: 18px;
            }
        }

        @media (max-width: 640px) {
            .service-duration {
                font-size: 16px;
            }
        }

        .service-divider {
            height: 1px;
            margin: 30px auto; /* <-- Уже было: 'auto' для горизонтального центрирования */
            background-color: #a73151;
            border: none;
            max-width: 800px; /* <-- Уже было: Максимальная ширина, как у service-item */
            width: 100%; /* <-- Уже было: Занимает 100% до max-width */
        }

        .footer {
            display: flex;
            align-items: center; /* <-- ИЗМЕНЕНО: Центрируем элементы по вертикали */
            justify-content: center; /* <-- ИЗМЕНЕНО: Центрируем элементы как группу по горизонтали */
            gap: 30px;
            margin-top: 60px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .footer {
                flex-direction: column;
                /* align-items: center; - Уже центрировано благодаря justify-content на маленьких экранах */
                gap: 20px;
                /* text-align: center; - Уже центрировано благодаря align-items в дочерних блоках */
                margin-top: 40px;
            }
        }

        .footer .logo {
            width: 80px;
            height: 80px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            align-items: center; /* <-- ИЗМЕНЕНО: Всегда центрируем контакты */
        }

        /* УДАЛЕНО: Медиа-запрос для выравнивания по правому краю на больших экранах */
        /*
        @media (max-width: 768px) {
            .contact-info {
                align-items: center;
            }
        }
        */

        .contact-phone {
            color: #a73151;
            letter-spacing: 2px;
            margin-bottom: 15px;
            font-size: 18px;
            font-family: 'Montserrat', sans-serif;
        }

        @media (max-width: 640px) {
            .contact-phone {
                font-size: 16px;
            }
        }

        .social-links {
            display: flex;
            flex-direction: column;
            align-items: center; /* <-- ИЗМЕНЕНО: Всегда центрируем соц. сети */
            gap: 10px;
        }

        /* УДАЛЕНО: Медиа-запрос для выравнивания по правому краю на больших экранах */
        /*
        @media (max-width: 768px) {
            .social-links {
                align-items: center;
            }
        }
        */

        .social-link {
            color: #a73151;
            letter-spacing: 2px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-link:hover {
            color: #881d3a;
        }

        @media (max-width: 640px) {
            .social-link {
                font-size: 14px;
            }
        }

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
            display: block; /* Сделаем кнопки блочными для работы margin: auto */
            width: 100%;
            max-width: 300px;
            padding: 12px 18px;
            border-radius: 10px;
            background-color: #da6886;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-align: center;
            transition: background-color 0.3s ease;
            box-sizing: border-box;
            margin: 10px auto 0; /* <-- ИЗМЕНЕНО: Центрируем кнопку с верхним отступом, нижний 0 */
        }
         .button:first-of-type {
             margin-top: 0; /* <-- НОВОЕ: Убираем верхний отступ у первой кнопки в группе */
         }


    </style>
</head>
<body>

<div class="salon-container">
<div class="header-container">
            <div class="header-nav">
                <a href="{{ route('main') }}" class="brand-container">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/27234bd614096077bf3ab6f70411fd2f7e8a3467?placeholderIfAbsent=true&apiKey=1f1e2d1492e74be8b445b694e3a68aae"
                        class="logo" alt="Логотип Nails.iirk">
                    <div>
                        <div class="brand-name">nails.iirk</div>
                        <span class="brand-quality">качество</span>
                        <span class="brand-elegance">изящность</span>
                    </div>
                </a>

                <div class="nav-buttons">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="nav-button profile">Профиль</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="nav-button logout" style="cursor: pointer;">Выйти</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-button">Вход</a>
                        <a href="{{ route('register') }}" class="nav-button">Регистрация</a>
                    @endauth
                </div>
            </div>
        </div>

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

        <hr class="service-divider">
        <section class="service-item">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ed88e645342152f08776ddc6f716b94523dfd7e1" alt="Коррекция ногтей" class="service-image">
            <div class="service-details">
                <h2 class="service-name">Коррекция 2000Р</h2>
                <p class="service-duration">2 часа</p>
                 @auth
                     <a href="{{ route('bookings.index') }}" class="button">Записаться онлайн</a>
                 @else
                     <a href="{{ route('register') }}" class="button">Записаться онлайн</a>
                 @endauth
                <a href="#example-main-link" class="button">На главную </a>
            </div>
        </section>

        <hr class="service-divider">
        <section class="service-item">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e79ff66fb3aceebf7824d03cb406f7df170906af" alt="Укрепление ногтей" class="service-image">
            <div class="service-details">
                <h2 class="service-name">Укрепление 1500Р</h2>
                <p class="service-duration">1 час 30 мин</p>
               @auth
                     <a href="{{ route('bookings.index') }}" class="button">Записаться онлайн</a>
                 @else
                     <a href="{{ route('register') }}" class="button">Записаться онлайн</a>
                 @endauth 
                <a href="#example-main-link" class="button">На главную </a>
            </div>
        </section>
    </main>

    <hr class="service-divider"> 
    <footer class="footer">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2166173af264b6b233ee79ec2f0ed8858f630d0c" alt="Логотип Nails.iirk" class="logo">
        <div class="contact-info">
            <p class="contact-phone">Связаться с нами: 89025497599</p>
            <nav class="social-links">
                <a href="#" class="social-link">Наш VK</a>
                <a href="#" class="social-link">Наш Instagram</a>
            </nav>
        </div>
    </footer>
</div>
</body>
</html>