<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $id)
 */
class User extends Model
{
    /**
     * @var string The database table associated with the model.
     */
    protected $table = 'users';

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = ['role_id', 'name', 'email', 'username', 'employee_id', 'password'];

    /**
     * Retrieves the user's associated role.
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Hash the password before saving.
     *
     * @param string $password The plain text password.
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
}
