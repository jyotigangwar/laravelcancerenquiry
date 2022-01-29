<x-layout>
  <!-- DataTables -->
  <link rel="stylesheet" href="{!! asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">
  <link rel="stylesheet" hre="{!! asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}">
  {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 text-right">
                <a href="{{ route('doctors.dashboard') }}" class="btn btn-danger"> Back </a>
            </div>
        </div>
        <div class="mt-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{Session::get('success')}}
                </div>
            @elseif(Session::has('failed'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{Session::get('failed')}}
                </div>
            @endif
        </div> 
        <div class="row">
            <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Enquiry Details </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('doctor.enquiry-details',$enquiry->id) }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName"><strong>Patient Name</strong></label> : {{$enquiry->full_name}}
                    </div>
                    <div class="form-group">
                        <label for="inputName"><strong>Email</strong></label> : {{$enquiry->email}}
                    </div>     
                    <div class="form-group">
                        <label for="inputName"><strong>Contact Number</strong></label> : {{$enquiry->contact_number}}{{$enquiry->patientstate["name"]}}
                    </div> 
                                       
                    <div class="form-group">
                        <label for="inputName"><strong>Address</strong></label> : {{$enquiry->address}} <br /><b>Pincode</b> : {{$enquiry->pincode}} 
                    </div> 
                    <div class="form-group">
                        <label for="inputName"><strong>State</strong></label> : {{$enquiry->patientstate["name"]}}
                    </div>
                    <div class="form-group">
                        <label for="inputName"><strong>City</strong></label> : {{$enquiry->patientcity["name"]}}
                    </div>                                                                              
                    <div class="form-group">
                                <label> <strong>Description</strong> </label>
                                <textarea class="form-control" rows="8" style="height:350px" cols="10" id="description" placeholder="Enter the Description" name="description"></textarea>
                            </div>                    
                    <div class="form-group">
                        <div class="col">
                            &nbsp;
                        </div>
                    </div>
                    <div class="form-group mt-10">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('doctors.dashboard') }}" class="btn btn-danger"> Back </a>
                    </div>
                </div>
                </form>
                <!-- /.card-body -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>File download Link</th>
                  </tr>
                  </thead>
                  <tbody>
                      @php $i=0; @endphp
                  @foreach($enquiryList as $enquiry)
                    <tr>
                        <td>{{ ++$i }} </td>
                        <td><a href="{{ asset("storage/".$enquiry->filename)}}" target="_new">Download</a></td>                       
                    </tr>
                @endforeach  
                      
                    </tbody>
                </table>
              </div>                
            </div>
            <!-- /.card -->
            </div>

        </div>
</div>  
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-layout>          







