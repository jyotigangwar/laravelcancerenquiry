<x-layout>
    <main class="form-signin">
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
        <form method="POST" action="/authenticate">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <p></p>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </form>
    </main>
</x-layout>