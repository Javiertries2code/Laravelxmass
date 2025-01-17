<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subjects(): BelongsToMany {
        return $this->BelongsToMany(Subject::class);
    }



    public function registrations(): HasMany {
        return $this->hasMany(Registration::class);
    }

}
