<?php

namespace App\Models;

use DateMalformedStringException;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $id)
 * @property string $status
 * @property datetime $start_date
 * @property datetime $end_date
 * @property int $duration
 */
class Vacation extends Model
{
    /**
     * @var string The database table associated with the model.
     */
    protected $table = 'vacations';

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = ['user_id', 'start_date', 'end_date', 'reason', 'status'];

    /**
     * @var array The attributes that are appendable.
     */
    protected $appends = ['duration'];

    /**
     * Calculates the duration in days.
     *
     * @return int
     * @throws DateMalformedStringException
     */
    public function getDurationAttribute(): int
    {
        $startDate = new DateTime($this->start_date);
        $endDate = new DateTime($this->end_date);

        return (int) date_diff($startDate, $endDate)->format('%a') + 1;
    }

    /**
     * Automatically capitalize the `status` attribute.
     *
     * @param $value
     * @return string
     */
    public function getStatusAttribute($value): string
    {
        return ucfirst($value);
    }

    /**
     * Automatically format the `created_at` attribute.
     *
     * @param $value
     * @return string
     * @throws DateMalformedStringException
     */
    public function getCreatedAtAttribute($value): string
    {
        return (new DateTime($value))->format('Y-m-d');
    }

    /**
     * Retrieves the associated user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Approves the vacation request.
     *
     * @return void
     */
    public function approve(): void
    {
        $this->status = 'approved';
        $this->save();
    }

    /**
     * Rejects the vacation request.
     *
     * @return void
     */
    public function reject(): void
    {
        $this->status = 'rejected';
        $this->save();
    }
}
