<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h1>Connected Devices</h1>
        @if(isset($devices) && count($devices) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Device ID</th>
                        <th>Device Name</th>
                        <th>Status</th>
                        <!-- Tambahkan kolom lainnya sesuai data yang ada -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($devices as $device)
                        <tr>
                            <td>{{ $device['device'] ?? '-' }}</td>
                            <td>{{ $device['name'] ?? '-' }}</td>
                            <td>{{ $device['status'] ?? '-' }}</td>
                            <!-- Tambahkan data lainnya sesuai response API -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No devices connected.</p>
        @endif
    </div>
</body>
</html>