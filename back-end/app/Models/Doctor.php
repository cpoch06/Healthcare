<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\DoctorInfo;

class Doctor extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'tbl_doctor';
    protected $primaryKey = 'doctor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function doctorInfo()
    {
        return $this->hasOne(DoctorInfo::class, 'doctor_id', 'doctor_id');
    }
}
