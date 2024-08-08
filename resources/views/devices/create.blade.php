<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Add Device</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('devices.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Device Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="device">Device Number</label>
            <input type="text" name="device" id="device" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="autoread">Activate Autoread</label>
            <input type="checkbox" name="autoread" id="autoread" value="true">
        </div>
        <div class="form-group">
            <label for="personal">Autoread Personal Chat</label>
            <input type="checkbox" name="personal" id="personal" value="true">
        </div>
        <div class="form-group">
            <label for="group">Autoread Group Chat</label>
            <input type="checkbox" name="group" id="group" value="true">
        </div>
        <button type="submit" class="btn btn-primary">Add Device</button>
    </form>
</div>
</body>
</html>