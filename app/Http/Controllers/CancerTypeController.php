<?php

namespace App\Http\Controllers;

use App\Models\CancerType;
use Illuminate\Http\Request;

class CancerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cancerTypes = CancerType::withCount('patients')->get();
        //$cancerTypes->withCount('patientdetails');
        return view("admin.cancertype.index", compact('cancerTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.cancertype.create");        
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
         $request->validate(
            [
                'cancer_name'=>'required|string',
            ]
        );

        $dataArray=array(
            'cancer_name' => $request->cancer_name
        );
        
        if(!is_null(CancerType::create($dataArray))) {
            return redirect('admin/cancertype')->with("Success", "Success! Cancer type created. ");
        }
        else {
            return redirect('admin/cancertype')->with("Failed", "Alert! Failed to create cancer type. ");
        }        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CancerType  $cancerType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $cancerTypes = CancerType::find($id);
        return view("admin.cancertype.show", ['cancertype' => $cancerTypes ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CancerType  $cancerType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cancerTypes = CancerType::find($id);
        return view("admin.cancertype.edit", ['cancertype' => $cancerTypes ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CancerType  $cancerType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate(
            [
                'cancer_name'=>'required|string',
            ]
        );

        $ctypes = CancerType::find($id);
        $ctypes->update([
            'cancer_name' => $request->cancer_name
        ]);        
        
        if(!is_null($ctypes)) {
            return redirect('admin/cancertype')->with("Success", "Success! Cancer type updated. ");
        }
        else {
            return redirect('admin/cancertype')->with("Failed", " Failed! to update cancer type. ");
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CancerType  $cancerType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $deleteType = CancerType::find($id);
        
        if(!is_null($deleteType->delete())) {
            return redirect('admin/cancertype')->with("Success", "Success! Cancer type deleted. ");
        }
        else {
            return redirect('admin/cancertype')->with("Failed", "Alert! Failed to delete cancer type. ");
        }          
    }
}
