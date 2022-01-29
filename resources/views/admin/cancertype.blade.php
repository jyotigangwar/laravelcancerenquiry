<x-layout>
@auth
    <p>Welcome {{auth()->user()->name}}
    <a href ="{{route('logout')}}">Logout</a></p>
@else

@endauth

Here goes form for cancer type

</x-layout>
