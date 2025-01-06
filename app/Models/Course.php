<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subjects(): HasMany {
        return $this->hasMany(Subject::class);
    }

    public function registrations(): HasMany {
        return $this->hasMany(Registration::class);
    }

}
