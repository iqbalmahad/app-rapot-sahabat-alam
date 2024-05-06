<?php

namespace App\Models;

use App\Models\Rapot;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['nis', 'tahun_masuk_tk', 'tahun_masuk_sd', 'tahun_masuk_smp', 'user_uuid'];
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function rapot()
    {
        return $this->hasMany(Rapot::class, 'siswa_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
