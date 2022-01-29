<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User register successfully.</title>
</head>
<body>
    Hello {{$name ?? ''}},

    <p>You have been registered with us successfully. Please use below login details to continue.</p>

   <p> User name : {{$email ?? ''}}</p>
   <p> Password : {{$password ?? ''}}</p>
   Thanks,
   {{ env('APP.APP_NAME') }} 
</body>
</html>