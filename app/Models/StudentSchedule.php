<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSchedule extends Model
{
    /** @use HasFactory<\Database\Factories\StudentScheduleFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function course(): BelongsTo{
        return $this->belongsTo(Course::class);
    }

    public function subjects(): HasMany {
        return $this->hasMany(Subject::class);
    }
}
