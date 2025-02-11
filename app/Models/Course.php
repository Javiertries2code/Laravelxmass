<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function subjects(): BelongsToMany {
        return $this->BelongsToMany(Subject::class);
    }

    public function registrations(): HasMany {
        return $this->hasMany(Registration::class, 'course_id');
    }

}
