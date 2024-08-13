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
                <h2 class="text-lg font-bold">(3)</h2>
            </div>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-[#0157FE] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                <img class="h-[20px] w-[20px] mr-2" src="../assets/img/ic_add_device.svg">
                Add New Device
            </a>
        </div>
        <!-- Device items -->
        <div class="space-y-2">
            <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                <!-- Text Section -->
                <div class="flex flex-col justify-center space-y-1">
                    <h2 class="font-semibold text-[16px]">Admin</h2>
                    <h2 class="font-light text-[12px]">085394923893</h2>
                </div>

                <!-- Device Status -->
                <div class="flex items-center space-x-2">
                    <span class="text-black text-sm">Status: </span>
                    <span class="text-green-600 text-sm">Connected</span>
                    <span class="h-3 w-3 bg-green-600 rounded-full"></span>
                </div>

                <!-- Actions Buttons -->
                <div class="flex space-x-2">
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-[#D00000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                        Disconnect
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                        Delete
                    </a>
                </div>
            </div>
            <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                <!-- Text Section -->
                <div class="flex flex-col justify-center space-y-1">
                    <h2 class="font-semibold text-[16px]">Admin</h2>
                    <h2 class="font-light text-[12px]">085394923893</h2>
                </div>

                <!-- Device Status -->
                <div class="flex items-center space-x-2">
                    <span class="text-black text-sm">Status: </span>
                    <span class="text-[#D00000] text-sm">Disconnected</span>
                    <span class="h-3 w-3 bg-[#D00000] rounded-full"></span>
                </div>

                <!-- Actions Buttons -->
                <div class="flex space-x-2">
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-[#7DDF64] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                        Connect
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                        Delete
                    </a>
                </div>
            </div>
            <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                <!-- Text Section -->
                <div class="flex flex-col justify-center space-y-1">
                    <h2 class="font-semibold text-[16px]">Admin</h2>
                    <h2 class="font-light text-[12px]">085394923893</h2>
                </div>

                <!-- Device Status -->
                <div class="flex items-center space-x-2">
                    <span class="text-black text-sm">Status: </span>
                    <span class="text-green-600 text-sm">Connected</span>
                    <span class="h-3 w-3 bg-green-600 rounded-full"></span>
                </div>

                <!-- Actions Buttons -->
                <div class="flex space-x-2">
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-[#D00000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                        Disconnect
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection