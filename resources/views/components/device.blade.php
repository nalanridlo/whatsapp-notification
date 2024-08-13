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
            <a id="add-user-btn" class="inline-flex items-center px-4 py-2 bg-[#0157FE] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                <img class="h-[20px] w-[20px] mr-2" src="../assets/img/ic_device_add-white.svg">
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
                    <a href="#"  class="inline-flex items-center px-4 py-2 bg-[#D00000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
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

<x-device-add />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addUserBtn = document.getElementById('add-user-btn');
        const addUserPopup = document.getElementById('add-device-popup');
        const closePopupBtn = document.getElementById('popup-close');

        // Open the popup when the button is clicked
        addUserBtn.addEventListener('click', function(event) {
            event.preventDefault();
            addUserPopup.classList.remove('hidden');
        });

        // Close the popup when the close button is clicked
        closePopupBtn.addEventListener('click', function() {
            addUserPopup.classList.add('hidden');
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                addUserPopup.classList.add('hidden');
            }
        });

        // Close the popup when clicking outside the main card
        addUserPopup.addEventListener('click', function(event) {
            if (event.target === addUserPopup) {
                addUserPopup.classList.add('hidden');
            }
        });
    });
</script>

@endsection