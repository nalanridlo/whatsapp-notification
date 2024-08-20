@extends('layouts.app')

@section('title', 'device')

@section('content')
<div class="grid gap-[20px]">
    <div class="bg-white rounded-[20px] p-[20px] overflow-y-auto">
        <div class="flex items-center justify-between mb-[12px]">
            <div class="flex items-center space-x-2">
                <img src="../assets/img/ic_devices_card.svg" alt="Devices Icon" class="w-6 h-6">
                <h2 class="text-lg font-bold">All Device</h2>
                <!-- Device counter -->
                <h2 class="text-lg font-bold">({{ count($devices) }})</h2>
            </div>
            <a id="add-user-btn" class="inline-flex items-center px-4 py-2 bg-[#0157FE] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                <img class="h-[20px] w-[20px] mr-2" src="../assets/img/ic_device_add-white.svg">
                Add New Device
            </a>
        </div>
        <!-- Device items -->
        <div class="space-y-2">
            @foreach ($devices as $device)
            <x-device-items :device="$device" :token="$device['token']" />
            @endforeach
        </div>
    </div>
</div>

<x-deviceAdd />

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/device.js') }}"></script>
@endpush