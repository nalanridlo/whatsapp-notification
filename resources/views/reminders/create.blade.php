<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="container">
    <h1 class="my-4">Create New Reminder</h1>
    <form method="POST" action="{{ route('reminders.store') }}">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Nomor WhatsApp</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggalLahir" id="tanggalLahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="reminder_date" class="form-label">Reminder Date</label>
            <input type="date" name="reminder_date" id="reminder_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="expire_date" class="form-label">Expire Date</label>
            <input type="date" name="expire_date" id="expire_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Reminder</button>
    </form>
</div>

</body>
</html>