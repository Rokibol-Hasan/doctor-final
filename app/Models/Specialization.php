<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Specialization extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($specialization) {
            $specialization->slug = Str::slug($specialization->name);
        });

        static::updating(function ($specialization) {
            $specialization->slug = Str::slug($specialization->name);
        });
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
