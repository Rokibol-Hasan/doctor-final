<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'location_id',
        'specialization_id',
        'bio',
        'phone',
        'email',
        'photo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($doctor) {
            $doctor->slug = Str::slug($doctor->name);
        });

        static::updating(function ($doctor) {
            $doctor->slug = Str::slug($doctor->name);
        });
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function chambers()
    {
        return $this->hasMany(Chamber::class);
    }
}
