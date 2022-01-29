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
                        <h3 class="card-title">View Doctor</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input value="{{ $users->name }}" readonly type="text" class="form-control" name="name" oninvalid="this.setCustomValidity('Please Enter valid name')" oninput="setCustomValidity('')" placeholder="User Name" required>
                            @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputName">Email</label>
                            <input value="{{ $users->email }}" readonly type="text" class="form-control" name="email" placeholder="test@test.com" required>
                            @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group" style="margin-top:20px">
                            <label for="inputName">Cancer Type</label> :
                            <strong>{{ $users['cancerTypes']['cancer_name'] }}</strong>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                &nbsp;
                            </div>
                        </div>
                        <div class="form-group mt-10">
                            <a href="{{ route('doctors.edit', $users->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('doctors.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>
</x-layout>