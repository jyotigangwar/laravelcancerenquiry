<x-layout>
@auth
    <p>Welcome {{auth()->user()->name}}
    <a href ="{{route('logout')}}">Logout</a></p>
@else


@endauth

Form and List of doctors here 


</x-layout>
