<x-layout>
@auth
    <p>Welcome {{auth()->user()->name}}</p>
    <a href ="{{route('logout')}}">Logout</a>
@else

@endauth

</x-layout>
