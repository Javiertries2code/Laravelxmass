<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Subject extends Model
{

    /** @use HasFactory<\Database\Factories\MeetingFactory> */
    use HasFactory;
    protected $guarded = [];

    public function courses(): BelongsToMany {
        return $this->BelongsToMany(Course::class);
    }


    public function schedules(): HasMany {
        return $this->hasMany(Schedule::class);
    }

}
