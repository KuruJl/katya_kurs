<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nails.iirk - Мастер маникюра Иркутск</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    /* Общие сбросы и базовые стили */
    html, body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      width: 100%;
      overflow-x: hidden;
      font-family: 'Montserrat', sans-serif;
      line-height: 1.5;
      color: #a73151;
      background-color:#feceda;
    }

    *, *:before, *:after {
      box-sizing: inherit;
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

    .nails-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 20px;
      text-align: center;
    }

    .content-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
      max-width: 960px;
      gap: 30px;
    }

    @media (min-width: 768px) {
      .nails-section {
        padding: 50px 30px;
      }
      .content-wrapper {
        gap: 40px;
      }
    }

    /* Стилизация логотипа в основном контенте */
    .logo {
      width: 100px;
      height: auto;
      border-radius: 15px;
      object-fit: contain;
      object-position: center;
    }
    @media (min-width: 768px) {
      .logo {
        width: 120px;
      }
    }

    /* Стилизация названия бренда и подписей в основном контенте */
    .brand-name {
      color:rgb(255, 255, 255);
      letter-spacing: 6px;
      font-size: 28px;
      font-weight: 600;
      text-transform: uppercase;
      font-family: 'Montserrat';
    }

    .brand-quality,
    .brand-elegance {
      font-family: 'Montserrat';
      letter-spacing: 5px;
      color:rgb(255, 255, 255);
      display: block;
      margin-top: 5px;
      font-size: 18px;
    }

    /* Стилизация основного изображения */
    .main-image {
      width: 100%;
      max-width: 800px;
      height: auto;
      border-radius: 15px;
      object-fit: cover;
      object-position: center;
      aspect-ratio: 2 / 1;
    }

    /* Стилизация разделительной линии */
    .divider {
      width: 100%;
      max-width: 800px;
      height: 1px;
      background-color: #a73151;
      border: none;
      margin: 0 auto;
    }
    @media (min-width: 768px) {
      .divider {
        height: 2px;
      }
    }

    /* Базовые стили для кнопок */
    .button {
      display: block;
      width: 100%;
      max-width: 600px;
      padding: 15px 20px;
      border-radius: 15px;
      background-color: #da6886;
      color: #fff;
      text-decoration: none;
      border: none;
      cursor: pointer;
      font-family: inherit;
      font-size: 20px;
      letter-spacing: 5px;
      text-transform: uppercase;
      text-align: center;
      transition: background-color 0.3s ease;
      box-sizing: border-box;
    }

    form .button {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      margin: 0;
      padding: 0;
      border: none;
      background: none;
      display: block;
      width: 100%;
      font-family: inherit;
      font-size: inherit;
      letter-spacing: inherit;
      color: inherit;
      text-transform: inherit;
      text-align: center;
      cursor: pointer;
      background-color: #da6886;
      color: #fff;
      border-radius: 15px;
      padding: 15px 20px;
      transition: background-color 0.3s ease;
      box-sizing: border-box;
      max-width: 600px;
    }

    .button:hover,
    form .button:hover {
      background-color: #c95a77;
    }

    @media (min-width: 768px) {
      .button,
      form .button {
        max-width: 800px;
        padding: 20px 40px;
        font-size: 24px;
        letter-spacing: 8px;
      }
      .address-button {
        padding: 15px 40px;
      }
    }

    /* --- Стили для блока мастера --- */
    .master-container {
      display: flex; /* Включаем Flexbox */
      flex-direction: column; /* По умолчанию элементы будут в колонку (для мобильных) */
      align-items: center; /* Центрируем элементы по горизонтали в колонке */
      gap: 30px; /* Отступ между элементами */
      width: 100%;
      max-width: 800px; /* Ограничиваем максимальную ширину контейнера мастера */
      margin: 0 auto; /* Центрируем сам контейнер мастера */
      background-color: #da6886; /* Фон для всего блока мастера */
      border-radius: 15px;
      padding: 25px 30px; /* Внутренние отступы */
      color: #fff; /* Цвет текста внутри блока мастера */
    }

    @media (min-width: 768px) {
      .master-container {
        flex-direction: row; /* На экранах >= 768px делаем элементы в ряд */
        align-items: flex-start; /* Выравниваем элементы по верху в ряду */
        gap: 40px; /* Увеличиваем отступ между колонками на больших экранах */
        padding: 34px 50px;
      }
    }

    .master-image-col {
      flex-basis: 50%; /* <-- ИЗМЕНЕНО: Увеличиваем базовую ширину колонки с изображением на мобильных */
      display: flex;
      justify-content: center; /* Центрируем изображение внутри колонки */
      width: 100%; /* Занимает всю доступную ширину в колонке */
    }

    .master-image-col img {
      display: block; /* Убираем лишний пробел под изображением */
      width: 100%; /* Изображение занимает всю ширину своей колонки */
      max-width: 350px; /* <-- ИЗМЕНЕНО: Увеличиваем максимальную ширину изображения на мобильных */
      height: auto;
      border-radius: 10px; /* Скругляем углы изображения */
      object-fit: cover;
      aspect-ratio: 1 / 1; /* Делаем изображение квадратным */
    }

    @media (min-width: 768px) {
      .master-image-col {
        flex-basis: 40%; /* <-- ИЗМЕНЕНО: Увеличиваем базовую ширину изображения на больших экранах */
        flex-shrink: 0; /* Запрещаем изображению сжиматься */
      }
      .master-image-col img {
        max-width: none; /* Сбрасываем max-width, чтобы flex-basis работал */
        width: 100%; /* Изображение занимает 100% ширины своей колонки */
      }
    }

    .master-details-col {
      flex-basis: 50%; /* <-- ИЗМЕНЕНО: Уменьшаем базовую ширину колонки с деталями на мобильных */
      display: flex;
      flex-direction: column;
      align-items: center; /* Центрируем элементы внутри колонки с деталями */
      gap: 15px; /* Отступ между элементами внутри колонки деталей */
      text-align: center; /* Выравниваем текст по центру */
      width: 100%; /* Занимает всю доступную ширину в колонке */
    }

    @media (min-width: 768px) {
      .master-details-col {
        flex-basis: 60%; /* <-- ИЗМЕНЕНО: Уменьшаем базовую ширину колонки с деталями на больших экранах */
        align-items: flex-start; /* Выравниваем элементы по левому краю на больших экранах */
        text-align: left; /* Выравниваем текст по левому краю на больших экранах */
      }
    }

    .master-name {
      letter-spacing: 6px;
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 10px; /* Уменьшаем отступ, так как есть gap в .master-details-col */
    }
    @media (min-width: 768px) {
      .master-name {
        font-size: 28px;
        margin-bottom: 0; /* Убираем margin-bottom, используем gap */
      }
    }


    .master-description {
      line-height: 1.6;
      letter-spacing: 3px;
      font-size: 16px;
      margin-bottom: 10px; /* Отступ перед кнопкой */
    }
    @media (min-width: 768px) {
      .master-description {
        font-size: 18px;
        margin-bottom: 0; /* Убираем margin-bottom, используем gap */
      }
    }

    .master-description span {
      display: block;
      margin-bottom: 8px;
    }
    .master-description span:last-child {
      margin-bottom: 0;
    }

    .master-works-button {
      display: block;
      width: 100%;
      max-width: 300px; /* Ограничиваем ширину кнопки */
      padding: 12px 18px;
      border-radius: 10px;
      background-color: #a73151; /* Цвет кнопки "Посмотреть работы" */
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
      margin-top: 15px; /* Отступ сверху от текста */
    }

    .master-works-button:hover {
      background-color: #881d3a;
    }

    @media (min-width: 768px) {
      .master-works-button {
        max-width: 350px; /* Немного увеличим ширину кнопки на больших экранах */
        margin-top: 20px; /* Увеличим отступ сверху */
      }
    }
    /* --- КОНЕЦ СТИЛЕЙ ДЛЯ БЛОКА МАСТЕРА --- */


    /* Стилизация контейнера для карты */
    .map-embed-container {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
      border-radius: 15px;
      overflow: hidden;
    }

    .map-embed-container iframe {
      display: block;
      width: 100%;
      height: 400px;
      border: none;
    }

    @media (min-width: 768px) {
      .map-embed-container iframe {
        height: 500px;
      }
    }

    .map-embed-container a[style*="position:absolute"] {
      z-index: 10;
    }

    /* Стилизация футера */
    .footer {
            display: flex;
            align-items: center; /* <-- ИЗМЕНЕНО: Центрируем элементы по вертикали */
            justify-content: center; /* <-- ИЗМЕНЕНО: Центрируем элементы как группу по горизонтали */
            gap: 30px;
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
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }

  </style>
</head>
<body>

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
              @if(auth()->user()->is_admin)
                  {{-- Убедитесь, что здесь именно такой роут --}}
                  <a href="{{ route('admin.bookings.index') }}" class="nav-button profile">Админ-панель</a>
              @endif
              
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


<div class="nails-section">
  <div class="content-wrapper">
    <img
      loading="lazy"
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/5258acbe37c29b3c98bc828b694038c53ac1c2bc?placeholderIfAbsent=true&apiKey=1f1e2d1492e74be8b445b694e3a68aae"
      class="main-image"
      alt="Примеры работ мастера маникюра"
    />

    <hr class="divider" aria-hidden="true" />
    <a href="https://t.me/tqwiti" class="button">Написать в Telegram</a>
    @auth
      <a href="{{ route('bookings.index') }}" class="button">Записаться онлайн</a>
    @else
      <a href="{{ route('register') }}" class="button">Записаться онлайн</a>
    @endauth
    <a href="{{ route('service') }}" class="button">Посмотреть услугу</a>
        <hr class="divider" aria-hidden="true" />

        <div class="master-container">
      <div class="master-image-col">
                <img src="https://i.ibb.co/tpgPXL2B/image.jpg" alt="Фотография мастера Катерины">
      </div>
      <div class="master-details-col">
        <div class="master-name">Мастер Катерина</div>
        <div class="master-description">
          <span>Опыт работы 4 года</span>
          <span>Стерильный инструмент</span>
          <span>Гарантия на покрытие 7 дней</span>
        </div>
                <a href="https://t.me/nailsiirk" class="master-works-button">Посмотреть работы</a>
      </div>
    </div>
    <div class="map-embed-container">
      <div style="position:relative;overflow:hidden;">
        <a href="https://yandex.ru/maps/63/irkutsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Иркутск</a>
        <a href="https://yandex.ru/maps/63/irkutsk/house/ulitsa_rozy_lyuksemburg_227/ZUkCaAZmQEEDVUJvYWJydHxqYw8=/?ll=104.171231%2C52.350338&utm_medium=mapframe&utm_source=maps&z=17.28" style="color:#eee;font-size:12px;position:absolute;top:14px;">Улица Розы Люксембург, 227 — Яндекс&nbsp;Карты</a>
        <iframe src="https://yandex.ru/map-widget/v1/?ll=104.171231%2C52.350338&mode=whatshere&whatshere%5Bpoint%5D=104.169346%2C52.350928&whatshere%5Bzoom%5D=17&z=17.28" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe>
      </div>
    </div>

    <hr class="divider" aria-hidden="true" />
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

  </div>
</div>

</body>
</html>
