<?php

namespace App\Models\Siswa;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaSD extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $fillable = [
        'nis',
        'status',
        'tahun_masuk_sd',
        'user_id',
    ];
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
