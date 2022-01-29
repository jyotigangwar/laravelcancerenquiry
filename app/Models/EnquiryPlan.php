<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryPlan extends Model
{
    use HasFactory;
    protected $table="enquiry_patient_plans";
    protected $fillable = [
        'doctor_id',
        'enquiry_patient_id',
        'plan',
        'filename',
    ];

}
