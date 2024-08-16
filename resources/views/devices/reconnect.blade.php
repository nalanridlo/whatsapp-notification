<div class="grid gap-[20px]">
    <div class="bg-white rounded-[20px] p-[20px] overflow-y-auto">
        <div class="flex items-center justify-between mb-[12px]">
            <h2 class="text-lg font-bold">Reconnect Device: {{ $device }}</h2>
        </div>
        <div class="flex justify-center">
            @if(isset($qrUrl))
                <img src="data:image/png;base64,{{ $qrUrl }}" alt="QR Code for Reconnect">
            @else
                <p>Failed to generate QR code for reconnecting the device.</p>
            @endif
        </div>
        <div class="flex justify-center mt-[20px]">
            <a href="{{ route('device') }}" class="inline-flex items-center px-4 py-2 bg-[#0157FE] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                Back to Devices
            </a>
        </div>
    </div>