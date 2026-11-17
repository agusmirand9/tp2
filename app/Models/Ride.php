<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * el servicio de cabalgata que ofrecemos
 */
class Ride extends Model
{
    protected $primaryKey = 'ride_id';

    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
        'price',
        'difficulty',
        'cover',
        'cover_description',

    ];

    /**
     * precio de la cabalgata por persona, se guarda en la base x100, y  lee /100, para
     * no tener error de redondeo con los decimales
     * @return Attribute
     */
    public function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value *100,
        );
    }

    /**
     * duracion de la cabalgata en formato de horas
     *  @return Attribute
     */
    public function durationLabel(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes): string {
                $hours = intdiv($attributes['duration_minutes'], 60);
                $minutes = $attributes['duration_minutes'] % 60;
                $parts = [];

                if ($hours > 0) {
                    $parts[] = $hours === 1 ? '1 hora' : $hours . ' horas';
                }

                if ($minutes > 0) {
                    $parts[] = $minutes . ' min';
                }

                return implode(' y ', $parts);
            },
        );
    }

    /**
     * las reservas que se hicieron a esa cabalgata
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'ride_fk', 'ride_id');
    }

}
