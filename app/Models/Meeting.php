<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    /** @use HasFactory<\Database\Factories\MeetingFactory> */
    use HasFactory;
    protected $guarded = [];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }


    public function course(): BelongsTo{
        return $this->belongsTo(Course::class);
    }


}
