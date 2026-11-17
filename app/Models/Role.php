<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * un rol de un usuario
 * @property int $role_id
 * @property string $name
 * @property-read string $label
 */

class Role extends Model
{
    protected $primaryKey = 'role_id';

    /**
     * nombre del rol español en pantalla
     */
    public function label(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => match ($attributes['name']) {
                'admin' => 'Administrador',
                default => 'Usuario',
            },
        );
    }

    /**
     * usuarios que tienen este rol
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_fk', 'role_id');
    }
}
