<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1>Add New Device</h1>

    <!-- Display error messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk menambahkan perangkat baru -->
    <form method="POST" action="{{ route('devices.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Device Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="device" class="form-label">Device Number</label>
            <input type="text" name="device" id="device" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="autoread" class="form-label">Autoread</label>
            <select name="autoread" id="autoread" class="form-control">
                <option value="false" selected>Off</option>
                <option value="true">On</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="personal" class="form-label">Personal Autoread</label>
            <select name="personal" id="personal" class="form-control">
                <option value="false" selected>Off</option>
                <option value="true">On</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="group" class="form-label">Group Autoread</label>
            <select name="group" id="group" class="form-control">
                <option value="false" selected>Off</option>
                <option value="true">On</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Device</button>
    </form>
</div>
</body>
</html>