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
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Nomor WhatsApp</th>
        <th>Expired Date</th>
    </tr>
</thead>
<tbody>
    @foreach($reminders as $reminder)
    <tr>
        <td>{{ $reminder->nama }}</td>
        <td>{{ $reminder->tanggalLahir }}</td>
        <td>{{ $reminder->phone_number }}</td>
        <td>{{ $reminder->expire_date }}</td>
    </tr>
    @endforeach
</tbody>
    </table>
</div>


</body>
</html>