<x-layout>
    <!-- DataTables -->
    <link rel="stylesheet" href="{!! asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">
    <link rel="stylesheet" hre="{!! asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}">

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                Go to <a href="{{route('admindashboard')}}">Dashboard</a>
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
                        <h3 class="card-title">View Cancer Types</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Name</label> : {{$cancertype->cancer_name}}

                        </div>
                        <div class="form-group">
                            <div class="col">
                                &nbsp;
                            </div>
                        </div>
                        <div class="form-group mt-10">
                            <a href="{{ route('cancertype.edit',$cancertype->id) }}" type="submit" class="btn btn-primary">Edit</a>
                            <a href="{{ route('cancertype.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>
</x-layout>