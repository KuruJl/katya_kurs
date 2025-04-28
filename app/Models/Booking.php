<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Импортировать BelongsTo

class Booking extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово присваивать.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'start_time',
        'end_time',
        'user_id', // Добавляем user_id сюда
        // 'service_id', // Если есть
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Получить пользователя, которому принадлежит запись.
     */
    public function user(): BelongsTo // Указываем тип возвращаемого значения
    {
        return $this->belongsTo(User::class); // Определяем связь "один ко многим" (обратная)
    }

    // Можно добавить связь с услугой, если есть модель Service
    // public function service(): BelongsTo
    // {
    //     return $this->belongsTo(Service::class);
    // }
}