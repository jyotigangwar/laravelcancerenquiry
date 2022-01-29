<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\PatientDetail;

class CancerType extends Model
{
    use HasFactory;//,SoftDeletes;


        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cancer_name',

    ];
    public function users()
    {
        //cancer has many doctors
        $this->hasMany(User::class,'cancer_id','id');
    }
    public function patients()
    {
        //cancer has many doctors
        return $this->hasMany(PatientDetail::class,'cancer_id','id');
        
    }
    public function patientsCount()
    {
        //cancer has many doctors
        return $this->hasMany(PatientDetail::class,'cancer_id','id');
        //$count = PatientDetail::class,'cancer_id','id');
        
    }
}
