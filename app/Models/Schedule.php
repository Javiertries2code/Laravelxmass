<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function subjects(): HasMany {
        return $this->hasMany(Subject::class);
    }
}
