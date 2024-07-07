<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class DoctorInfo extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'tbl_doctor_info';
    protected $primaryKey = 'doctor_info_id';

    protected $fillable = [
        'doctor_id',
        'speciality',
        'experience',
        'edu_background',
        'work_days',
        'work_start_hour',
        'work_end_hour',
        'fellowships',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'work_days' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }
}
