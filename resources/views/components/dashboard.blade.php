@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
<div class="grid grid-cols-2 gap-[20px]">
    <!-- Left Column: Device Connected and Users List -->
    <div class="space-y-[20px]">
        <!-- Card 1: Device Connected List -->
        @include('devices.index', ['devices' => $devices])

        <!-- Card 3: Users List -->
        <div class="bg-white rounded-[20px] p-[20px] max-h-[300px] overflow-y-auto">
            <div class="overflow-x-auto">
            @include('reminders.index', ['reminders' => $reminders])    
            </div>
        </div>
    </div>
    <!-- Right Column: Notification List -->
    <div class="space-y-[20px]">
        <div class="bg-white rounded-[20px] p-[20px] flex flex-col  overflow-y-auto ">
            <div class="flex items-center justify-between mb-[12px]">
                <div class="flex items-center space-x-4">
                    <img src="../assets/img/ic_notification.svg" alt="Notification Icon">
                    <h2 class="text-xl font-bold">Notification</h2>
                </div>
            </div>
            <div class="space-y-2">
                <!-- Notification items -->
                <!-- Example of a single item -->
                @forelse($notifications as $notification)
                <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                    <div>
                        <h2 class="font-semibold text-[12px]">Insert Data</h2>
                        <h2 class="font-light text-[10px]">User data uploaded successfully</h2>
                    </div>
                    <div class="flex items-center">
                        <span class="text-black text-sm">Status: </span>
                        <span class="text-green-600 text-sm">Success</span>
                        <span class="ml-2 h-3 w-3 bg-green-600 rounded-full"></span>
                    </div>
                </div>
                @empty
                <p>No notifications found.</p>
                 @endforelse
            </div>
        </div>
    </div>
</div>
@endsection