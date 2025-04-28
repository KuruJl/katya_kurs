<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_bookings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable(); // Сделаем nullable на всякий случай
            // Добавляем связь с таблицей users
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Связь с users, удаление записей при удалении юзера
            // Можно добавить другие поля: service_id, status и т.д.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};