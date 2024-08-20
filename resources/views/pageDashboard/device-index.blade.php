@props(['devices'])
<div class="bg-white rounded-[20px] p-[20px] border-[3px] border-[#0157FE] max-h-[200px] flex flex-col">
    <div class="flex items-center justify-between mb-[12px] sticky top-0 bg-white z-10">
        <div class="flex items-center space-x-2">
            <img src="../assets/img/ic_devices_card.svg" alt="Devices Icon" class="w-6 h-6">
            <h2 class="text-lg font-bold">All Devices</h2>
            <!-- Device counter -->
            <h2 class="text-lg font-bold">({{ count($devices) }})</h2>
        </div>
        <a href="{{ route('device') }}" class="text-[#0157FE] text-xs underline font-semibold font-inter">Show More</a>
    </div>

    <!-- Device items -->
    <div class="space-y-2 overflow-y-auto flex-1">
        @if(isset($devices) && count($devices) > 0)
        @foreach($devices as $device)
        <div class="flex justify-between items-center">
            <div class="text-sm font-semibold">{{ $device['name'] ?? 'Unnamed' }} - {{ $device['device'] }}</div>
            <div class="flex items-center space-x-1">
                <span class="{{ $device['status'] === 'connect' ? 'text-green-600' : 'text-red-600' }} text-sm">
                    {{ strtolower($device['status'] ?? 'Unknown') }}
                </span>
                <span class="h-3 w-3 {{ $device['status'] === 'connect' ? 'bg-green-600' : 'bg-red-600' }} rounded-full"></span>
            </div>
        </div>
        @endforeach
        @else
        <div class="text-sm text-gray-500">No devices connected.</div>
        @endif
    </div>
</div>