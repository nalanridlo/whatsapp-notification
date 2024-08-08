<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
@if (isset($devices))
    <h2>Connected Device Information</h2>
    <ul>
    <ul>
        <li><strong>Device Name:</strong> {{ $devices['name'] ?? 'N/A' }}</li>
        <li><strong>Device Number:</strong> {{ $devices['device'] ?? 'N/A' }}</li>
        <li><strong>Autoread:</strong> {{ $devices['autoread'] ?? 'N/A' }}</li>
        <li><strong>Group:</strong> {{ $devices['group'] ?? 'N/A' }}</li>
        <li><strong>Personal:</strong> {{ $devices['personal'] ?? 'N/A' }}</li>
        <li><strong>Token:</strong> {{ $devices['token'] ?? 'N/A' }}</li>
    </ul>
    </ul>
@else
    <p>No devices found or an error occurred.</p>
@endif

</div>
</body>
</html>