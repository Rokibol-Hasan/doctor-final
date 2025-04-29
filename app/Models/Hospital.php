<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'location_id',
        'address',
        'phone',
        'email',
        'website',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($hospital) {
            $hospital->slug = Str::slug($hospital->name);
        });

        static::updating(function ($hospital) {
            $hospital->slug = Str::slug($hospital->name);
        });
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function chambers()
    {
        return $this->hasMany(Chamber::class);
    }

    /**
     * Get the locations for the hospital.
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
