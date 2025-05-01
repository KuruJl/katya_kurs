<style>
    .custom-profile-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .profile-forms-container {
        max-width: 600px;
        margin: 0 auto;
    }
    .profile-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .danger-zone {
        border: 1px solid #ff6b6b;
    }
    h2 {
        color: #a73151;
        margin-top: 0;
    }
</style>

<x-app-layout>
    <!-- Ваш заголовок -->
    <div class="custom-profile-header">
        <h1>Привет, {{ Auth::user()->name }}! 👋</h1>
        <p>Редактируйте ваш профиль</p>
    </div>

    <!-- Обёртка для форм -->
    <div class="profile-forms-container">
        <!-- Форма данных -->
        <div class="profile-card">
            <h2>📝 Основные данные</h2>
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Форма пароля -->
        <div class="profile-card">
            <h2>🔐 Смена пароля</h2>
            @include('profile.partials.update-password-form')
        </div>

        <!-- Форма удаления -->
        <div class="profile-card danger-zone">
            <h2>❌ Удалить аккаунт</h2>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>