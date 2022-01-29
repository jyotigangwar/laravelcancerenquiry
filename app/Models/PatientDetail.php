<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\CancerType;
class PatientDetail extends Model
{
    use HasFactory, SoftDeletes;

       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'state_id',
        'city_id',
        'address',
        'pincode',
        'cancer_id',
        'filenames',
        'password',
        'status',
        'doctor_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

      /**
     *
     * @param  string  $value
     * @return void
     */
    public function setFilenamesAttribute($value)
    {
        $this->attributes['filenames'] = json_encode($value);
    }

    public function cancertypep()
    {
        //cancer has many doctors
        return  $this->BelongsTo(CancerType::class,'id','cancer_id');
    }

    public function doctors()
    {
        //cancer has many doctors
        return  $this->BelongsTo(User::class,'id','doctor_id');
    }
    public function patientstate()
    {
        //cancer has many doctors
        return  $this->BelongsTo(State::class,'state_id');
    }
    public function patientcity()
    {
        //cancer has many doctors
        return  $this->BelongsTo(City::class,'state_id');
    }

}
