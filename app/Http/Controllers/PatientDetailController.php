<?php

namespace App\Http\Controllers;

use App\Models\PatientDetail;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\CancerType;

class PatientDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // To get all the States of country = india
        // Retrieve all the states
        $states = State::where('country_id','101')->get();

        // Retrieve all Cancer types
        $cancerTypes = CancerType::get();
        
        return view('patient-details',compact('states','cancerTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        var_dump($request->all());
        $strArr = ($request->validate(
            [
                'full_name'         =>      'required|string',
                'email'             =>      'required|email|unique:patient_details,email',
                'password'          =>      'required|alpha_num|min:8',
                'confirm_password'  =>      'required|same:password',
                'contact_number'    =>      'required|numeric|min:10',
                'state_id'          =>      'required',
                'city_id'           =>      'required',
                'pincode'           =>      'required|regex:/^[1-9][0-9]{5}$/i',
                'cancer_type'       =>      'required',
                'address'           =>      'required|',
            ]
        ));

        /*$this->validate($request, [
            'filenames' => 'request|mimes:pdf,jpg,jpeg|max:2048',//doc,pdf,docx,png,jpg,jpeg,mp4,mov,ogx,oga,ogv,ogg,webm|max:102048'
            'filenames.*' => 'required|mimes:pdf,jpg,jpeg|max:2048'//doc,pdf,docx,png,jpg,jpeg,mp4,mov,ogx,oga,ogv,ogg,webm|max:102048'
            ]);
        */
        $files = [];
        if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
                $name = time().$file->extension().rand(1,100).'.'.$file->extension();
                $file->move(public_path('files'), $name);  
                $files[] = $name;  
            }
         }

        $dataArray      =       array(
            'full_name'         =>      $request->full_name,
            'email'             =>      $request->email,
            'password'          =>      $request->password,
            'contact_number'    =>      $request->contact_number,
            'state_id'          =>      $request->state_id,
            'city_id'           =>      $request->city_id,
            'pincode'           =>      $request->pincode,
            'cancer_id'         =>      $request->cancer_type,
            'address'           =>      $request->address,
            'filenames'         =>      $files
        );
        $patientEnquiry =   PatientDetail::create($dataArray);
        if(!is_null($patientEnquiry)) {
            return back()->with("success", "Success! Enquiry Submitted successfully");
        }

        else {
            return back()->with("failed", "Alert! Failed to submit Enquiry");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientDetail  $patientDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PatientDetail $patientDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientDetail  $patientDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientDetail $patientDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientDetail  $patientDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientDetail $patientDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientDetail  $patientDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientDetail $patientDetail)
    {
        //
    }

    public function getCities($id){
        ($cities= City::where('state_id',$id)->get());
        return response()->json(['cities' => $cities]);
   }


}
