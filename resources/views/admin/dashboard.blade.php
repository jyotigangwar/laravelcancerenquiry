<x-layout>


    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Welcome to dashboard</h5>
            <div class="card-body">
                <h5 class="card-title">Crud operations for admin</h5>
                <p class="card-text">User with id one is considered as fixed admin</p>
                @auth
                <a href="{{route('doctors.index')}}" class="btn btn-primary">Manage Doctors </a>
                <a href="{{route('cancertype.index')}}" class="btn btn-primary">Manage Cancer Types</a>
                @endauth
            </div>
        </div>

    </div>

</x-layout>