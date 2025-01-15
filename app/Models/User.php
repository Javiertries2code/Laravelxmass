<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongstoMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Permission\Traits\HasRoles;




class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];


    //Puede tener varios meettings
    public function meetings(): BelongstoMany {
        return $this->BelongstoMany(Meeting::class);
    }

    //por simplicidad y de momento, puede tener varias (matriculas pasadas, status inactivo, ya veremos si le dejo estar en dos cursos
    //a la vex, lo mismo es mu espabilao el chico :-P)
    public function registrations(): BelongstoMany {
        return $this->BelongstoMany(Registration::class);
    }

    public function schedules(): HasMany {
        return $this->hasMany(Schedule::class);
    }


    public function courses(): BelongsToMany {
        return $this->belongsToMany(Course::class, 'registrations', 'user_id', 'course_id');
    }



   // existe la opcion return $this->hasManyThrough(Subject::class,... para llegar a la conexion de por ejemplo, subjects por profe


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
