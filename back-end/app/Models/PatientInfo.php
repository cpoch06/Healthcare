<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class PatientInfo extends Model
{   
    use HasFactory, HasApiTokens;
    protected $table = 'tbl_patient_info';
    protected $primaryKey = 'patient_info_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_nationality',
        'patient_id',
        'patient_visit',
        'weight',
        'height',
        'blood_type',
        'blood_pressure',
        'symptoms',
        'patient_info',
        'patient_history',
        'patient_plan',
        'medications',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

  
}
