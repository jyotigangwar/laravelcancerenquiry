<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use App\Mail\NotifyCategoryMail   ;
use Illuminate\Mail\Mailable;
use App\Models\PatientDetail;
use App\Models\EnquiryPlan;
use PDF;
use App\Models\CancerType;
use App\Mail\SendEnquiryPlanMail;
class AdminController extends Controller
{
    //
    public function dashboard(){

        if(!Auth::check()){
            return redirect()->intended('/login');
        }
        $user = Auth::user();
        return view('admin.dashboard');
    }

    public function createDoctor(){
  
        if(!Auth::check()){
            return redirect()->intended('/login');
        }
        return view('admin.doctor');
    }

    public function createCancerType(){
  
        if(!Auth::check()){
            return redirect()->intended('/login');
        }
        return view('admin.cancertype');
    }

    public function register(Request $request) {
          $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'cancer_type'=>'required'
          ]);
          $newPassword = Str::random(10);
          $data = [
            'name' => $request->name,
            'email' => $request->email,
            'cancer_id'=> $request->cancer_type,
            'password'=>bcrypt($newPassword)
          ];
            //'password'=>Hash::make($newPassword)

          if(User::create($data)) {
          $data = array('name'=>$request->name, 'email'=>$request->email, 'password'=>$newPassword );
            //Mail::send('emails.userregister', ['name' => $request->name,'category_description' => $request->description], function ($message)
            Mail::send('emails.userregister', $data, function ($message)
            {
                $message->from('vb.jyoti@gmail.com', 'Jyoti Rani');
                $message->to("vb.jyoti@gmail.com");
                $message->subject('Doctor register successfully');
            });
            
            if (Mail::failures()) {
                return redirect('admin/doctors')->with("Failure", "Success! Doctor created successfully, But mail cant be sent. ");
            }else{
                return redirect('/admin/doctors')->with("Success", "Success! Doctor created successfully. ");
            }
        }
        else {
            return redirect('/admin/doctors')->with("Success", "Success! Doctor can't be created. ");
        }

    }


       /** 
    * This will show the enquiry list to the Doctors
   */
   public function showEnquiry(){
    $doctorCancertype = Auth()->user()->cancer_id;
    $users = Auth::user();
    $cancerName = $users["cancerTypes"]->cancer_name;
    $enquirys = PatientDetail::where('cancer_id','=',$doctorCancertype)->get();
    //$enquiry = PatientDetail::where('cancer_id','=',$doctorCancertype)->with('cancertype')->get();
    return view('admin.enquiry-list', compact('enquirys','cancerName'));
    }

    /** 
    * This will show the enquiry details to the Doctors
   */
   public function enquiryDetails($id){
        $enquiryList = "";
        $enquiry = PatientDetail::with("patientstate")->with('patientcity')->where('id','=',$id)->first();
        $enquiryList = EnquiryPlan::where('doctor_id','=',Auth()->user()->id)
                                  ->where('enquiry_patient_id','=',$id)->get();
        return view('admin.enquiry-details', compact('enquiry','enquiryList'));
   }

   public function enquiryCreatePlan(Request $request,$id){
       //$this->generatePDF();
    $enquiry = PatientDetail::with("patientstate")->with('patientcity')->where('id','=',$id)->first();
    $data1 = [
        'doctor_name' => Auth()->user()->name,
        'doctor_email' => Auth()->user()->email,
        'test_plan' => $request->description,
        'date' => date('m/d/Y'),
        'patient_name' => $enquiry->full_name,
        'patient_email' => $enquiry->email,
        'patient_number' => $enquiry->contact_number,
        'patient_address' => $enquiry->address,
        'patient_pincode' => $enquiry->pincode,
    ];
        
     $doctor_id = Auth()->user()->id;
     $filename = "enquiry/plans/".time().$id.".pdf";

     $dataArray=array(
        'doctor_id' => $doctor_id,
        'enquiry_patient_id' => $id,
        'plan' => $request->description,
        'filename' => $filename
     );
     if(!is_null(EnquiryPlan::create($dataArray))) {
        $pquery = PatientDetail::find($id);
        $pquery->update([
            'status' => 1,
            'doctor_id' => $doctor_id,
        ]); 
        //$pdf1->download('public/pdf/invoice.pdf');
        if($this->generatePDF($data1,$filename)) {
            $this->sendEmailPlan($data1,$filename);
            return redirect('doctor/dashboard')->with("Success", "Success! Plan created . ");
        }
        else {
            return  redirect('doctor/dashboard')->with("Failed", "Alert! Failed to create PDF, but plan has been created. ");
        }
    }
    else {
        return  redirect('doctor/dashboard')->with("Failed", "Alert! Failed to create plan. ");
    } 
  }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($data1,$filename)
    {
        $filename = "public/".$filename;
        $pdf1 = PDF::loadView('admin.planpdf', $data1);
        return Storage::put($filename, $pdf1->output());
    }

    public function sendEmailPlan($data,$filename)
    {
        $data = $data;
        $filenamepath=$filename;
        (Mail::to("jyoti.rani@neosoftmail.com")->send(new SendEnquiryPlanMail($data,$filenamepath)));

        
        if (Mail::failures()) {
            return true;
        }else{
            return false;
        }
    }

}
