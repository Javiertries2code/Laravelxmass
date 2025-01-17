<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;


class Subject extends Model
{
    use SoftDeletes;

    /** @use HasFactory<\Database\Factories\MeetingFactory> */
    use HasFactory;
    protected $guarded = [];

    public function courses(): BelongsToMany {
        return $this->BelongsToMany(Course::class);
    }


    public function schedules(): BelongsToMany {
        return $this->BelongsToMany(Schedule::class);
    }

}
