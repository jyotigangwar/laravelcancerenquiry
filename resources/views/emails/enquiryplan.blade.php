<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan generated</title>
</head>
<body>
    Hello {{$patient_name ?? ''}},

    <p>Your enquiry plan has been generated successfully.
         Please see attached file to view details.</p>

   Thanks,
   {{ env('APP.APP_NAME') }} 
</body>
</html>