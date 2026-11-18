<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * representa la reserva de un usuario a la cabalgata
 */

class Booking extends Model
{
    protected $primaryKey = 'booking_id';

    /**
     * conversion automatica del tipo para los atributos
     *  @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'ride_date' => 'date',
        ];
    }

    /**
     * precio total de la reserva, se guarda en la base x100, y se lee /100
     * @return Attribute
     */

    public function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100,
        );
    }

    /**
     * cabalgata que se reservó
     * @return BelongsTo
     */
    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class, 'ride_fk', 'ride_id');
    }

    /**
     * usuario que hizo la reserva
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_fk', 'id');
    }
}
