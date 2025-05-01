<!DOCTYPE html>
<html lang="ru"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nails.iirk - Мастер маникюра Иркутск</title> <style>
        /* Общие сбросы и базовые стили */
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box; /* Применяем ко всему */
            width: 100%;
            overflow-x: hidden; /* Предотвращаем горизонтальный скролл */
            font-family: 'Inter', sans-serif; /* Используем шрифт Inter */
            line-height: 1.5; /* Улучшенный интервал между строками по умолчанию */
            color: #a73151; /* Основной цвет текста */
            background-color: #feceda; /* Основной цвет фона */
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        /* Секция основного контента - Flexbox для центрирования и вертикального расположения */
        .nails-section {
            display: flex;
            flex-direction: column;
            align-items: center; /* Центрируем содержимое по горизонтали */
            min-height: 100vh; /* Занимает всю высоту экрана */
            padding: 30px 20px; /* Отступы по бокам и сверху/снизу */
            text-align: center;
        }

        /* Обертка для контента с ограничением ширины */
        .content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 960px; /* Ограничиваем максимальную ширину контента */
            /* Используем gap для единообразных вертикальных отступов между элементами */
            gap: 30px; /* Отступ по умолчанию для мобильных */
        }

        /* Медиа-запрос для больших экранов */
        @media (min-width: 768px) {
            .nails-section {
                padding: 50px 30px;
            }
            .content-wrapper {
                gap: 40px; /* Увеличиваем отступ на больших экранах */
            }
        }


        /* Стилизация логотипа */
        .logo {
            width: 100px; /* Размер логотипа по умолчанию */
            height: auto; /* Сохраняем пропорции */
            border-radius: 15px;
            object-fit: contain;
            object-position: center;
        }
         @media (min-width: 768px) {
             .logo {
                 width: 120px; /* Увеличиваем размер на больших экранах */
             }
         }


        /* Стилизация названия бренда и подписей */
        .brand-name {
            color: #a73151;
            letter-spacing: 6px;
            font-size: 28px;
            font-weight: 600; /* Добавим немного жирности */
            text-transform: uppercase; /* Можно сделать заглавными буквами */
        }

        .brand-quality,
        .brand-elegance {
            letter-spacing: 5px;
            color: #a73151;
            display: block; /* Каждая подпись на новой строке */
            margin-top: 5px; /* Небольшой отступ между подписями */
            font-size: 18px;
        }

        /* Стилизация основного изображения */
        .main-image,
        .map-image { /* Применяем общие стили к обоим изображениям */
            width: 100%; /* Изображение занимает всю доступную ширину контейнера */
            max-width: 800px; /* Но не превышает максимальную ширину */
            height: auto; /* Автоматическая высота для сохранения пропорций */
            border-radius: 15px;
            object-fit: cover; /* Обрезка для сохранения пропорций, если необходимо */
            object-position: center;
            aspect-ratio: 2 / 1; /* Задаем соотношение сторон */
        }

        /* Стилизация разделительной линии */
        .divider {
            width: 100%; /* Линия занимает всю доступную ширину контейнера */
            max-width: 800px; /* Но не превышает максимальную ширину */
            height: 1px;
            background-color: #a73151;
            border: none;
            margin: 0 auto; /* Центрируем горизонтально */
        }
         @media (min-width: 768px) {
             .divider {
                 height: 2px; /* Немного толще на больших экранах */
             }
         }


        /* Базовые стили для кнопок и ссылок, стилизованных как кнопки */
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

        /* Стили для кнопки внутри формы (например, Выйти) */
        form .button {
             /* Убираем стандартные стили браузера для кнопки внутри формы */
             -webkit-appearance: none;
             -moz-appearance: none;
             appearance: none;
             /* Сбрасываем отступы и границы, которые могут добавиться по умолчанию */
             margin: 0;
             padding: 0;
             border: none;
             background: none;
             /* Применяем стили кнопки */
             display: block; /* Или inline-block, если нужно, чтобы ширина была по содержимому */
             width: 100%; /* Занимает всю ширину формы */
             font-family: inherit;
             font-size: inherit;
             letter-spacing: inherit;
             color: inherit;
             text-transform: inherit;
             text-align: center;
             cursor: pointer;
             /* Применяем общие стили из класса .button */
             background-color: #da6886;
             color: #fff;
             border-radius: 15px;
             padding: 15px 20px;
             transition: background-color 0.3s ease;
             box-sizing: border-box;
             max-width: 600px; /* Ограничение ширины */
         }


        .button:hover {
            background-color: #c95a77;
        }

        /* Медиа-запрос для кнопок на больших экранах */
        @media (min-width: 768px) {
            .button,
            form .button { /* Применяем ко всем кнопкам/ссылкам-кнопкам */
                 max-width: 800px; /* Увеличиваем максимальную ширину */
                 padding: 20px 40px;
                 font-size: 24px;
                 letter-spacing: 8px;
             }
             /* Если нужна разная высота для кнопок, можно добавить модификаторы */
             .address-button {
                  padding: 15px 40px; /* Меньшая высота для кнопки адреса */
             }
        }


        /* Стилизация блока информации о мастере */
        .master-info {
            background-color: #da6886;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px 30px; /* Внутренние отступы */
            color: #fff;
            width: 100%; /* Занимает всю доступную ширину */
            max-width: 600px; /* Ограничение максимальной ширины */
        }
         @media (min-width: 768px) {
             .master-info {
                 max-width: 800px; /* Увеличиваем максимальную ширину */
                 padding: 34px 50px;
             }
         }

        .master-details {
            text-align: center;
        }

        .master-name {
            letter-spacing: 6px;
            font-size: 24px;
            font-weight: 600; /* Сделаем имя мастера чуть жирнее */
            margin-bottom: 15px; /* Отступ после имени */
        }

        .master-description {
            line-height: 1.6; /* Увеличен интервал между строк для читаемости */
            letter-spacing: 3px;
            font-size: 16px;
        }
        .master-description span {
            display: block; /* Каждое свойство на новой строке */
            margin-bottom: 8px;
        }
        .master-description span:last-child {
            margin-bottom: 0;
        }

        /* Стилизация футера */
        .footer-divider { /* Стили такие же, как у обычного разделителя */
             width: 100%;
             max-width: 800px;
             height: 1px;
             background-color: #a73151;
             border: none;
             margin: 0 auto;
        }
        @media (min-width: 768px) {
            .footer-divider {
                height: 2px;
                max-width: 1000px; /* Футер может быть шире */
            }
        }


        .footer-content {
            display: flex;
            flex-direction: column; /* По умолчанию элементы в столбец */
            align-items: center; /* Центрируем по горизонтали в столбике */
            width: 100%;
            max-width: 800px; /* Ограничение ширины футера */
            gap: 20px; /* Отступ между элементами футера */
            font-size: 16px;
            color: #a73151;
            letter-spacing: 2px;
            text-align: center; /* Центрируем текст в футере по умолчанию */
        }

        @media (min-width: 768px) {
            .footer-content {
                flex-direction: row; /* На больших экранах - в строку */
                justify-content: space-between; /* Распределяем элементы по ширине */
                align-items: center; /* Выравниваем по центру по вертикали */
                max-width: 1000px; /* Увеличиваем максимальную ширину */
                font-size: 20px;
                letter-spacing: 3px;
                gap: 30px; /* Увеличиваем гэп между элементами в строке */
            }
        }

        .footer-content .logo {
            width: 80px; /* Меньше лого в футере */
            border-radius: 10px; /* Немного меньше радиус */
        }
         @media (min-width: 768px) {
             .footer-content .logo {
                 width: 100px; /* Увеличиваем на больших экранах */
                 border-radius: 15px;
             }
         }

        .contact-info {
            display: flex;
            flex-direction: column;
            align-items: center; /* Центрируем в столбике */
        }
         @media (min-width: 768px) {
             .contact-info {
                 align-items: flex-end; /* Выравниваем по правому краю в строке */
             }
         }

        .phone-number {
             margin-bottom: 10px; /* Отступ после номера телефона */
        }

        .social-links {
            display: flex;
            flex-direction: column;
            align-items: center; /* Центрируем в столбике */
            gap: 8px; /* Отступ между ссылками */
        }
         @media (min-width: 768px) {
             .social-links {
                 align-items: flex-end; /* Выравниваем по правому краю в строке */
             }
         }

        .social-links a {
            color: #a73151;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .social-links a:hover {
            color: #da6886;
        }

        /* Стили для скрытия контента */
        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Дополнительные стили для улучшения внешнего вида */
        h1, h2, h3, h4, h5, h6 {
             margin-top: 0;
             margin-bottom: 0;
        }
/* Стилизация основного изображения */
       /* .main-image, */ /* Убираем .map-image отсюда */
       .main-image { /* Применяем общие стили только к основному изображению */
           width: 100%; /* Изображение занимает всю доступную ширину контейнера */
           max-width: 800px; /* Но не превышает максимальную ширину */
           height: auto; /* Автоматическая высота для сохранения пропорций */
           border-radius: 15px;
           object-fit: cover; /* Обрезка для сохранения пропорций, если необходимо */
           object-position: center;
           aspect-ratio: 2 / 1; /* Задаем соотношение сторон */
       }


        /* Стилизация контейнера для встраиваемой карты Яндекса */
        .map-embed-container {
            width: 100%; /* Занимает всю доступную ширину родителя */
            max-width: 800px; /* Ограничиваем максимальную ширину, как у других блоков */
            margin: 0 auto; /* Центрируем блок горизонтально */
            border-radius: 15px; /* Применяем скругление углов к контейнеру */
            overflow: hidden; /* Обрезаем содержимое по границам контейнера */
            /* position: relative; /* Уже есть во внутреннем div Яндекса, но можно и здесь */
        }

        /* Стилизация самого iframe карты */
        .map-embed-container iframe {
            display: block; /* Убираем возможные нижние отступы у iframe */
            width: 100%; /* iframe занимает 100% ширины своего родителя (.map-embed-container) */
            height: 400px; /* Задаем фиксированную высоту. Можно сделать ее отзывчивой, если нужно */
            border: none; /* Убираем рамку iframe */
            /* Удалены inline стили width, height, frameborder */
        }

        /* Можно добавить медиа-запрос для изменения высоты карты на разных экранах, если 400px недостаточно или слишком много */
        @media (min-width: 768px) {
            .map-embed-container iframe {
                height: 500px; /* Пример: делаем карту выше на больших экранах */
            }
        }

        /* Убедимся, что ссылки Яндекса остаются поверх карты */
         .map-embed-container a[style*="position:absolute"] {
             z-index: 10; /* Устанавливаем z-index выше, чем у iframe */
         }


        /* Стилизация разделительной линии */
        .divider {
            width: 100%; /* Линия занимает всю доступную ширину контейнера */
            max-width: 800px; /* Но не превышает максимальную ширину */
            height: 1px;
            background-color: #a73151;
            border: none;
            margin: 0 auto; /* Центрируем горизонтально */
        }
         @media (min-width: 768px) {
             .divider {
                 height: 2px; /* Немного толще на больших экранах */
             }
         }

    </style>
</head>
<body>

<div class="nails-section">
    <div class="content-wrapper">
        <img
            loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/27234bd614096077bf3ab6f70411fd2f7e8a3467?placeholderIfAbsent=true&apiKey=1f1e2d1492e74be8b445b694e3a68aae"
            class="logo"
            alt="Логотип Nails.iirk"
        />
        <div class="brand-name">
            nails.iirk
            <span class="brand-quality">качество</span>
            <span class="brand-elegance">изящность</span>
        </div>

        <img
            loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/5258acbe37c29b3c98bc828b694038c53ac1c2bc?placeholderIfAbsent=true&apiKey=1f1e2d1492e74be8b445b694e3a68aae"
            class="main-image"
            alt="Примеры работ мастера маникюра"
        />

        <hr class="divider" aria-hidden="true" />
         @auth
            <a href="{{ route('profile.edit') }}" class="button">Профиль</a>
            <form method="POST" action="{{ route('logout') }}" style="width: 100%; max-width: 600px;">
                @csrf
                <button type="submit" class="button">Выйти</button> </form>
        @else
            <a href="{{ route('login') }}" class="button">Вход</a>
            <a href="{{ route('register') }}" class="button">Регистрация</a>
        @endauth

        <a href="https://t.me/tqwiti" class="button">Написать в Telegram</a> 
        @auth
            <a href="{{ route('bookings.index') }}" class="button">Записаться онлайн</a>
        @else
            <a href="{{ route('register') }}" class="button">Записаться онлайн</a>
        @endauth       
         <a href="{{ route('service') }}" class="button">Посмотреть услугу</a> 
        <a href="https://t.me/nailsiirk" class="button">Посмотреть работы</a> <hr class="divider" aria-hidden="true" /> 
        <div class="master-info">
            <div class="master-details">
                <div class="master-name">Мастер Катерина</div>
                <div class="master-description">
                    <span>Опыт работы 4 года</span>
                    <span>Стерильный инструмент</span>
                    <span>Гарантия на покрытие 7 дней</span>
                </div>
            </div>
        </div>

        <button class="button address-button">Наш адрес</button> <div class="map-embed-container">
            <div style="position:relative;overflow:hidden;">
                <a href="https://yandex.ru/maps/63/irkutsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Иркутск</a>
                <a href="https://yandex.ru/maps/63/irkutsk/house/ulitsa_rozy_lyuksemburg_227/ZUkCaAZmQEEDVUJvYWJydHxqYw8=/?ll=104.171231%2C52.350338&utm_medium=mapframe&utm_source=maps&z=17.28" style="color:#eee;font-size:12px;position:absolute;top:14px;">Улица Розы Люксембург, 227 — Яндекс Карты</a>

                <iframe src="https://yandex.ru/map-widget/v1/?ll=104.171231%2C52.350338&mode=whatshere&whatshere%5Bpoint%5D=104.169346%2C52.350928&whatshere%5Bzoom%5D=17&z=17.28" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe>
                 </div>
        </div>
        <hr class="footer-divider" aria-hidden="true" />

        <hr class="footer-divider" aria-hidden="true" /> <footer class="footer-content">
            <img
                loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/27234bd614096077bf3ab6f70411fd2f7e8a3467?placeholderIfAbsent=true&apiKey=1f1e2d1492e74be8b445b694e3a68aae"
                class="logo"
                alt="Логотип Nails.iirk в подвале"
            />
            <div class="contact-info">
                <div class="phone-number">Связаться с нами: 89025497599</div>
                <div class="social-links">
                    <a href="#" class="vk-link">Наш VK</a>
                    <a href="#" class="inst-link">Наш Instagram</a>
                </div>
            </div>
        </footer>

    </div>
</div>

</body>
</html>