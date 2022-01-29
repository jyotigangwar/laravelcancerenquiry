<x-layout>
  <!-- DataTables -->
  <link rel="stylesheet" href="{!! asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">
  <link rel="stylesheet" hre="{!! asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}">
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('Success'))
                <div class="alert alert-success alert-dismissible">
                    {{Session::get('Success')}}
                </div>
            @elseif(Session::has('Failed'))
                <div class="alert alert-danger alert-dismissible">
                    {{Session::get('Failed')}}
                </div>
            @endif           
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Enquiries for {{$cancerName}}</h3>
                <h3 class="card-title" style="float:right">

              </div>
            
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Enquiry Status</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                      @php $i=0; @endphp 
                  @foreach($enquirys as $enquiry)
                    <tr>
                        <td>{{ ++$i }} </td>
                        <td>{{ $enquiry->full_name }} </td>
                        <td>{{ $enquiry->email }} </td>
                        <td>{{ $enquiry->contact_number }} </td>
                        
                        <td class="project-actions text-right"> 
                        @if($enquiry->status ==0)
                            New
                            @else
                                Locked
                            @endif
                        </td>
                        <td class="project-actions text-right">
                            @if($enquiry->doctor_id == Auth::id())
                            <a  href="{{ route('doctor.enquiry-details', $enquiry->id) }}"  class="btn btn-primary " href="#">
                              View</a>
                            @elseif($enquiry->status ==0)
                            <a  href="{{ route('doctor.enquiry-details', $enquiry->id) }}"  class="btn btn-primary " href="#">
                              View</a>
                            @else
                                Locked
                            @endif</td>                        
                    </tr>
                @endforeach  
                      
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>



</x-layout>