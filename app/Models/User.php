<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\CancerType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\PatientDetail;

class User extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cancer_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * 
     */
    public function cancerTypes()
    {
        return $this->belongsTo(CancerType::class,'cancer_id');
    }
/*
    public function setpasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make(Str::random(10));
    }*/

    /*
        check user is only administrator 
    */
    public static function isAdmin(){
        $isAdmin = false;
        if( auth()->user()->id == 1)
        {
            $isAdmin = true;
        }
       return $isAdmin;
    }
    //Doctors has many patients
    public function patients(){
        return $this->hasMany(PatientDetail::class,'doctor_id','id');
    }

}
