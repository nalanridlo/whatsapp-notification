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
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="reminder_date" class="form-label">Reminder Date</label>
            <input type="date" name="reminder_date" id="reminder_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="reminder_time" class="form-label">Reminder Time</label>
            <input type="time" name="reminder_time" id="reminder_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

</body>
</html>