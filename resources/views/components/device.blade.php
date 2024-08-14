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
        <div id="device-list" class="space-y-2">
            <x-device-items />
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