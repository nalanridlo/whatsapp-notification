@extends('layouts.app')

@section('title', 'dashboard')

@section('content')

<div class="flex gap-[20px] h-full">
    <!-- Left Column: Device Connected and Users List -->
    <div class="flex-1 flex flex-col gap-[20px]">
        <!-- Card 1: Device Connected List -->
        @include('pageDashboard.device-index', ['devices' => $devices])

        <!-- Card 3: Users List -->
        <div class="bg-white rounded-[20px] flex-1 p-[20px] max-h-full overflow-y-auto">
            <div class="overflow-x-auto h-full border-[1px] border-[#E0E0E0]">
            @include('pageDashboard.users-index', ['reminders' => $reminders])    
            </div>
        </div>
    </div>
    <!-- Right Column: Notification List -->
    <div class="flex-1 flex flex-col">
        <div class="bg-white rounded-[20px] p-[20px] flex flex-col overflow-y-auto max-h-full">
            <div class="flex items-center justify-between mb-[12px]">
                <div class="flex items-center space-x-4">
                    <img src="../assets/img/ic_notification.svg" alt="Notification Icon">
                    <h2 class="text-xl font-bold">Notification</h2>
                </div>
            </div>
            <div class="space-y-2 overflow-y-auto">
                <!-- Notification items -->
                @forelse($notifications as $notification)
                    @include('pageDashboard.notification-index', ['notification' => $notification])
                @empty
                <p>No notifications found.</p>
                 @endforelse
            </div>
        </div>
    </div>
</div>
@endsection