
<x-layout>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">


            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-12">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><h2>Fill the patient details</h2>
                            </div>
                        </div>

                        <!--new-->
                        <div class="container-fluid">
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

                            <div class="patient details">       
                                
                                <form class="row g-3" method="POST"  enctype="multipart/form-data" action="{{route('patientdetails.store')}}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label for="inputEmail4" class="form-label">Full Name</label>
                                        <input  
                                        value="{{ old('full_name') }}" 
                                        type="text" 
                                        class="form-control" 
                                        name="full_name" 
                                        oninvalid="this.setCustomValidity('Please Enter valid name')"
                                        oninput="setCustomValidity('')"
                                        placeholder="Full Name" required>    
                                        @if ($errors->has('full_name'))
                                            <span class="text-danger text-left">{{ $errors->first('full_name') }}</span>
                                        @endif                                                                       
                                    </div>     
                                </div> 
                                <div class="row g-3">      
                                    <div class="col-6">
                                        <label for="inputEmail4" class="form-label">Password</label>
                                        <input  
                                        type="password" 
                                        class="form-control" 
                                        name="password" 
                                        oninvalid="this.setCustomValidity('Please Enter valid password')"
                                        oninput="setCustomValidity('')"
                                        placeholder="" required>    
                                        @if ($errors->has('password'))
                                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                        @endif 
                                    </div>
                                </div> 
                                <div class="row g-3">  
                                    <div class="col-6">
                                        <label for="inputEmail4" class="form-label">Confirm Password</label>
                                        <input  
                                        type="password" 
                                        class="form-control" 
                                        name="confirm_password" 
                                        oninvalid="this.setCustomValidity('Please Enter valid password')"
                                        oninput="setCustomValidity('')"
                                        placeholder="" required>    
                                        @if ($errors->has('confirm_password'))
                                            <span class="text-danger text-left">{{ $errors->first('confirm_password') }}</span>
                                        @endif                                         
                                    </div> 
                                </div> 
                                <div class="row g-3">                                         
                                    <div class="col-6">
                                        <label for="inputPassword4" class="form-label">Email</label>
                                        <input  value="{{ old('email') }}" 
                                        type="text" 
                                        class="form-control" 
                                        name="email" 
                                        oninvalid="this.setCustomValidity('Please Enter valid email')"
                                        oninput="setCustomValidity('')"
                                        placeholder="test@demo.com" required>    
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif  
                                    </div>
                                </div> 
                                <div class="row g-3">                                  
                                    <div class="col-6">
                                        <label for="inputPassword4" class="form-label">Contact Number</label>
                                        <input  value="{{ old('contact_number') }}" 
                                        type="number" 
                                        class="form-control" 
                                        name="contact_number" 
                                        oninvalid="this.setCustomValidity('Please Enter valid number.')"
                                        oninput="setCustomValidity('')"
                                        placeholder="Mobile number" required>    
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('contact_number') }}</span>
                                        @endif  
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <label for="state">Select your State</label>
                                    <input type="hidden" value="{{old('state_id')}}" id="ostateid" name="old_stateid">

                                    <select name="state_id" id="state" class="form-select" 
                                    oninvalid="this.setCustomValidity('Please Select State.')"
                                        oninput="setCustomValidity('')" required>
                                        <option value="">Select State</option>  
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}" {{ old("state_id") == $state->id ? 'selected="selected"' : '' }}>{{$state->name}}</option>
                                        @endforeach                     
                                    </select>    
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" value="{{old('city_id')}}" id="ocityid" name="old_cityid">
                                    <label for="city">Select your City</label>
                                    <select name="city_id" id="city" class="form-select"
                                    oninvalid="this.setCustomValidity('Please Select City.')"
                                        oninput="setCustomValidity('')" required>
                                    <option value="">Select City</option>   
                                    </select>    
                                </div>
                                <div class="row g-3">                                          
                                    <div class="col-6">
                                        <label for="inputAddress" class="form-label">Address</label>
                                        <textarea value="" id="address" name="address"
                                        class="form-control" rows="4"
                                        oninvalid="this.setCustomValidity('Please Enter valid address')"
                                        oninput="setCustomValidity('')"                        
                                        placeholder="1234 Main St" required>{{ old('address') }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                        @endif 
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Pin</label>
                                    <input value="{{ old('pincode') }}" 
                                        type="number" 
                                        class="form-control" 
                                        name="pincode" 
                                        oninvalid="this.setCustomValidity('Please Enter pincode.')"
                                        oninput="setCustomValidity('')"
                                        placeholder="Pincode" required>    
                                        @if ($errors->has('pincode'))
                                            <span class="text-danger text-left">{{ $errors->first('pincode') }}</span>
                                        @endif 
                                </div>                                 
                                <div class="row g-3">                                  
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">Type of Cancer</label>
                                        <select id="inputState" name="cancer_type" class="form-select" 
                                        oninvalid="this.setCustomValidity('Please Select type of Cancer.')"
                                        oninput="setCustomValidity('')" required>
                                            <option value="">Choose...</option>
                                            @foreach($cancerTypes as $ctypes)
                                                <option value="{{$ctypes->id}}" 
                                                {{ old("cancer_type") == $ctypes->id ? 'selected="selected"' : '' }}>
                                                {{$ctypes->cancer_name}}</option>
                                            @endforeach                                              
                                        </select>                                        
                                    </div>
                                </div>                                

                                <div class="col-12">
                                    <div class="form-check">
                                    <label class="form-label" for="gridCheck">
                                        <b>Upload files</b>
                                    </label>
                                    </div>
                                </div>
                                <div class="input-group hdtuto control-group lst increment" >
                                <input type="file" name="filenames[]" class="myfrm form-control">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                                </div>
                                <div class="clone hide">
                                <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                    <div class="input-group-btn"> 
                                    <button class="btn btn-danger" type="button">
                                        <i class="fldemo glyphicon glyphicon-remove"></i> 
                                        Remove</button>
                                    </div>
                                </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                            </form>
                        
                        </div>                        
                        <!--new-->
                    </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                   
                </div>
            </div>
        </div>
       <script>
    
           $(document).ready(function(){

             $('#state').on('change',function(){
                var state_id= $(this).val();

                 console.log('asdasdasd',$(this).val(),"{{url('/getCities')}}/",state_id)
                if (state_id) {
                 $.ajax({
                    url: "{{url('/getCities')}}/"+state_id,
                  type: "GET",
                  dataType: "json",
                  success: function(html){
                    console.log(html.cities);
                    $('select[name="city_id"]').empty();
                    $.each(html.cities,function(i, cities){
                      console.log(cities.city_id);
                        $('select[name="city_id"]').append('<option value="'+cities.id+'">'+cities.name+'</option>');
                    });
                  }
                 });
                }else {
                     $('select[name="city_id"]').empty();
               }
           });
                old_city_id = $('#ocityid').val();
                old_state_id = $('#ostateid').val();
                if(old_state_id!= "")
                {
                    if (old_state_id) {
                                $.ajax({
                                    url: "{{url('/getCities')}}/"+old_state_id,
                                type: "GET",
                                dataType: "json",
                                success: function(html){
                                    console.log(html.cities);
                                    $('select[name="city_id"]').empty();
                                    $.each(html.cities,function(i, cities){
                                        $('select[name="city_id"]').append('<option value="'+cities.id+'">'+cities.name+'</option>');
                                    });
                                }
                                });
                                }else {
                                    $('select[name="city_id"]').empty();
                            }
                }
          
          
          
          });
          $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
            });
            $("body").on("click",".btn-danger",function(){
                alert('delete me') ;
                $(this).parents(".hdtuto").remove();
            });
  </script>
</x-layout>