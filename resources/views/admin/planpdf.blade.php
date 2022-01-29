<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<body>
    <h1>Doctor Name : {{ $doctor_name }}</h1>
    <p><strong>Doctor email</strong> : {{ $doctor_email }}</p>
    <p>Patient Name : {{ $patient_name }}</p>
    <p>Email : {{ $patient_email }}</p>
    <p>Contact Number : {{ $patient_number }}</p>
    <p>Address : {{ $patient_address }}</p>
    <p>Pincode : {{ $patient_pincode }}</p>
    <p>Test Plan : <br />{!! $test_plan !!}</p>
    <p>{{ $date }}</p>

</body>
</html>