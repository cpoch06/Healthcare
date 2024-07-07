<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMapping extends Model
{
    use HasFactory;

    protected $table = 'tbl_user'; 
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'doctor_id',
        'patient_id',
    ];

}
