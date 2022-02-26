<!DOCTYPE html>
<html>
<head>
    <title>Mail Board</title>
</head>
<body>
    <h1>{{ $mails['title'] }}</h1>
    <p>
        One Application found to your Posted Job <strong style="color: green"> {{ $mails['job_title'] }} </strong>
    </p>
    <p>Applicant Name: <strong>{{ $mails['applicant'] }}</strong></p>
    <p>Applicant Email: <strong>{{ $mails['email'] }}</strong></p>
    <p>Apply Date: <strong>{{ format_date(date('Y-m-d')) }}</strong></p>

    <p>Thank you</p>
    <p>Admin</p>
</body>
</html>
