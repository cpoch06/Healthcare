<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_appointment';
    protected $primaryKey = 'appointment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'patient_Lname',
        'patient_Fname',
        'patient_age',
        'gender',
        'address',
        'national_card',
        'phone_number',
        'passport',
        'appointment_date',
        'appointment_time',
        'preferred_physician',
        'symptoms',
        'staus',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'patient_id' => 'integer',
        'patient_age' => 'integer',
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i'// Use datetime cast with only hour and minute
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    
}
