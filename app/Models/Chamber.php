<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chamber extends Model
{
    protected $fillable = [
        'doctor_id', 
        'hospital_id', 
        'location_id',
        'address', 
        'visiting_hours', 
        'days', 
        'contact_number'
    ];


    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }

    public function location(): BelongsTo
{
    return $this->belongsTo(Location::class);
}

}
