<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="container">
    <h1 class="my-4">Scheduled Messages</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Message</th>
                <th scope="col">Reminder Date</th>
                <th scope="col">Reminder Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reminders as $reminder)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $reminder->phone_number }}</td>
                <td>{{ $reminder->message }}</td>
                <td>{{ $reminder->reminder_date }}</td>
                <td>{{ $reminder->reminder_time }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


</body>
</html>