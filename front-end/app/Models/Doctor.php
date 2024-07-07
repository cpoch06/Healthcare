<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'tbl_doctor';
    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'doctor_Lname',
        'doctor_Fname',
        'doctor_age',
        'gender',
        'doctor_email',
        'password',
        'doctor_profile',
        'phone_number',
        'user_type_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function doctorInfo()
    {
        return $this->hasOne(DoctorInfo::class, 'doctor_id', 'doctor_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    
}