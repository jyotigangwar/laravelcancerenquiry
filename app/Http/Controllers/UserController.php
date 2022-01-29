<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CancerType;

class UserController extends Controller
{
    //It will display the login screen
    public function login()
    {
        return view('login');
    }

 /**
  * Handle an authentication attempt.
  *
  * @param  \Illuminate\Http\Request $request
  *
  * @return Response
  */
    public function authenticate(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...

            if(User::isAdmin()) 
                return redirect()->intended('admin/dashboard');
            else
                return redirect()->intended('/doctor/dashboard');              

        }
        else{
                //TO DO errors
                   return redirect('/login')->with("Failed", " Failed! to login. ");
        }
    }

    //It will redirect the use to the login screen
    //Or to the dashboard page
    public function dashboard(){

        if(!Auth::check()){
            return redirect()->intended('/login');
        }
        $user = Auth::user();
        return view('dashboard');
    }

    //User will be logout 
    public function logout(){
        Auth::logout();
        return redirect()->intended('/login');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('cancerTypes')->with('patients')->where('id','!=',1)->get();
        return view("admin.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieve all Cancer types
        $cancerTypes = CancerType::get();
        return view("admin.users.create", compact('cancerTypes'));
    }

 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        return view("admin.users.show", compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view("admin.users.edit", compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'=>'required|string',
            ]
        );

        $ctypes = User::find($id);
        $ctypes->update([
            'name' => $request->name
        ]);        
        if(!is_null($ctypes)) {
            return redirect('admin/doctors')->with("Success", "Success! Doctor updated . ");
        }
        else {
            return redirect('admin/doctors')->with("Failed", " Failed! to update Doctor. ");
        }         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteType = User::find($id);
        
        if(!is_null($deleteType->delete())) {
            return redirect('/admin/doctors')->with("Success", "Success! User deleted. ");
        }
        else {
            return redirect('/admin/doctors')->with("Failed", "Alert! Failed to delete user. ");
        }          
    }
}
