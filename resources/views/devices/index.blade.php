<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard Page </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            /* Apply Inter font to entire document */
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
    </head> 
    <body> 
    @props(['devices'])
<div class="bg-white rounded-[20px] p-[20px] border-[3px] border-[#0157FE] max-h-[200px] overflow-y-auto">
    <div class="flex items-center justify-between mb-[12px]">
        <div class="flex items-center space-x-2">
            <img src="../assets/img/ic_devices_card.svg" alt="Devices Icon" class="w-6 h-6">
            <h2 class="text-lg font-bold">All Devices</h2>
            <!-- Device counter -->
            <h2 class="text-lg font-bold">({{ count($devices) }})</h2>
        </div>
        <a href="{{ route('device') }}" class="text-[#0157FE] text-xs underline font-semibold font-inter">Show More</a>
    </div>
    
    <!-- Device items -->
    <div class="space-y-2">
        @if(isset($devices) && count($devices) > 0)
            @foreach($devices as $device)
                <div class="flex justify-between items-center">
                    <div class="text-sm font-semibold">{{ $device['name'] ?? 'Unnamed' }} - {{ $device['device'] }}</div>
                    <div class="flex items-center">
                    <span class="{{ $device['status'] === 'connect' ? 'text-green-600' : 'text-red-600' }} text-sm">
                        {{ strtolower($device['status'] ?? 'Unknown') }}
                    </span>
                    <span class="h-3 w-3 {{ $device['status'] === 'connect' ? 'bg-green-600' : 'bg-red-600' }} rounded-full"></span>
                        <!-- <form action="{{ route('devices.requestOtp', $device['device']) }}" method="POST" class="ml-2">
                            @csrf
                            <button type="submit" class="text-red-600 text-xs underline">Delete</button>
                        </form> -->
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-sm text-gray-500">No devices connected.</div>
        @endif
    </div>
</div>
</body>
</html>