<!-- deviceItems.blade.php -->
<div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
    <!-- Text Section -->
    <div class="flex flex-col justify-center space-y-1">
        <h2 class="font-semibold text-[16px]">{{ $device['name'] }}</h2>
        <h2 class="font-light text-[12px]">{{ $device['device'] }}</h2>
        <h2 class="hidden">{{ $token }}</h2>
    </div>

    <!-- Device Status -->
    <div class="flex items-center space-x-2">
        <span class="text-black text-sm">Status: </span>
        @if ($device['status'] === 'connect')
        <span class="text-green-600 text-sm">Connected</span>
        <span class="h-3 w-3 bg-green-600 rounded-full"></span>
        @else
        <span class="text-[#D00000] text-sm">Disconnected</span>
        <span class="h-3 w-3 bg-[#D00000] rounded-full"></span>
        @endif
    </div>

    <!-- Actions Buttons -->
    <div class="flex space-x-2">
        @if ($device['status'] === 'connect')
        <form action="{{ route('devices.disconnect', ['device' => $device['device']]) }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#D00000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                Disconnect
            </button>
        </form>
        @else
        <button type="button"  class="reconnect-btn inline-flex items-center px-4 py-2 bg-[#7DDF64] text-white text-xs font-semibold rounded-lg hover:bg-blue-700"
            data-device="{{ $device['device'] }}"
            data-token="{{ $token }}">
            Reconnect
        </button>
        @endif
        <button type="button"  class="delete-btn px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-gray-800"
            data-device="{{ $device['device'] }}"
            data-token="{{ $token }}">
            Delete
        </button>
    </div>

    <x-device-action-delete :device="$device" :token="$token" />

    <x-device-action-connection :device="$device" :token="$token" />

</div>

