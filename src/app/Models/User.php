<?php

namespace App\Models;

use App\Core\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 * @property int $id
 * @property string $name
 * @property int $remaining_vacation_days
 * @property Role $role
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
     * @var array The attributes that are appendable.
     */
    protected $appends = ['first_name', 'remaining_vacation_days'];

    /**
     * Hash the password before saving.
     *
     * @param string $password The plain text password.
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Calculates the user's first name.
     *
     * @return string
     */
    public function getFirstNameAttribute(): string
    {
        return trim(explode(' ', $this->name)[0]);
    }

    /**
     * Calculates the user's remaining vacation days for the current year.
     *
     * @return int
     */
    public function getRemainingVacationDaysAttribute(): int
    {
        $totalDaysAllowed = Config::get('app')['vacation_days'];
        $currentYear = date('Y');
        $vacations = $this->vacations()
            ->whereYear('start_date', $currentYear)
            ->where('status', 'approved')
            ->get();

        $usedDays = $vacations->sum('duration');

        return $totalDaysAllowed - $usedDays;
    }

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
     * Retrieves the user's associated role.
     *
     * @return HasMany
     */
    public function vacations(): HasMany
    {
        return $this->hasMany(Vacation::class);
    }

    /**
     * Retrieves the total users with employee role.
     *
     * @return int
     */
    public function totalEmployees(): int
    {
        return $this->where('role_id', Role::where('name', 'employee')->first()->id)->count();
    }
}
