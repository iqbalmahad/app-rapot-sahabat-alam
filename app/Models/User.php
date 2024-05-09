<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Siswa;
use Illuminate\Support\Str;
use App\Models\Siswa\SiswaSD;
use App\Models\Siswa\SiswaTK;
use App\Models\Siswa\SiswaSMP;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'username', 'email', 'password','is_first_visit'];
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }

    public function siswaTk()
    {
        return $this->hasOne(SiswaTK::class, 'user_id', 'id');
    }

    public function siswaSd()
    {
        return $this->hasOne(SiswaSD::class, 'user_id', 'id');
    }

    public function siswaSmp()
    {
        return $this->hasOne(SiswaSMP::class, 'user_id', 'id');
    }
}
