<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * usuario del sitio
 */
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Conversion automatica de tipos de los atributos
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Rol asignado a un usuario
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_fk', 'role_id');
    }

    /**
     * post del usuario
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_fk');
    }

    /**
     * reservas del usuario
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class,'user_fk');
    }

    /**
     * Indica si el usuario es admin.
     * Carga el rol solo si todavia no esta cargado
     * @return bool
     */
    public function isAdmin():bool
    {
        return $this->loadMissing('role')->role->name === 'admin';
    }
}
