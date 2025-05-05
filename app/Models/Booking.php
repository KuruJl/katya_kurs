<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Импортировать BelongsTo
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово присваивать.
     *
     * @var array<int, string>
     */
    protected $fillable = ['start_time', 'end_time', 'user_id'];


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
    public function user()
{
    return $this->belongsTo(User::class);
}
public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('start_time', '>=', Carbon::now());
    }
    // Можно добавить связь с услугой, если есть модель Service
    // public function service(): BelongsTo
    // {
    //     return $this->belongsTo(Service::class);
    // }
}