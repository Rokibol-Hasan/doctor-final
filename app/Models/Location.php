<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'hospital_id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            $location->slug = Str::slug($location->name);
        });

        static::updating(function ($location) {
            $location->slug = Str::slug($location->name);
        });
    }

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Get the hospital that this location belongs to.
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}
