@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-[20px]">
    <!-- Left Column: Device Connected and Users List -->
    <div class="space-y-[20px]">
        <!-- Card 1: Device Connected List -->
        <div class="bg-white rounded-[20px] p-[20px] border-[3px] border-[#0157FE] max-h-[200px] overflow-y-auto">
            <div class="flex items-center justify-between mb-[12px]">
                <div class="flex items-center space-x-2">
                    <img src="../assets/img/ic_devices_card.svg" alt="Devices Icon" class="lg:w-6 lg:h-6 w-4 h-4">
                    <h2 class="lg:text-lg font-bold text-sm">All Device</h2>
                    <!-- Device counter -->
                    <h2 class="lg:text-lg font-bold text-sm">(1)</h2>
                </div>
                <a href="{{ route('device') }}" class="text-[#0157FE] lg:text-xs text-[9px] underline font-semibold">Show More</a>
            </div>
            <!-- Device items -->
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <div class="lg:text-sm text-xs font-semibold mr-[32px]">Admin 1 08686849694968</div>
                    <div class="flex items-center">
                        <span class="hidden lg:inline md:inline lg:text-green-600 md:text-green-600 lg:text-sm text-xs">Connected</span>
                        <span class="ml-2 h-3 w-3 bg-green-600 rounded-full"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Users List -->
        <div class="bg-white rounded-[20px] p-[20px] max-h-[300px] overflow-y-auto">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-[#FFFFFF] rounded-[20px] border border-[#E0E0E0]">
                    <thead class="bg-[#F5F5F5] rounded-t-[20px]">
                        <tr class="border-b border-[#E0E0E0]">
                            <th class="p-[10px] text-left text-sm font-semibold" colspan="4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <img src="../assets/img/ic_users_card.svg" alt="Users Icon" class="lg:w-6 lg:h-6 w-4 h-4">
                                        <h2 class="lg:text-lg font-bold text-sm">Users List</h2>
                                    </div>
                                    <a href="{{ route('users') }}" class="text-[#0157FE] lg:text-xs text-[9px] underline font-semibold">Manage Users</a>
                                </div>
                            </th>
                        </tr>
                        <tr class="border-b border-[#E0E0E0]">
                            <th class="p-[10px] text-left lg:text-sm md:text-xs font-semibold text-[9px] w-[25%] border-r border-[#E0E0E0]">Nama</th>
                            <th class="p-[10px] text-left lg:text-sm md:text-xs font-semibold text-[9px] w-[25%] border-r border-[#E0E0E0]">Tanggal Lahir</th>
                            <th class="p-[10px] text-left lg:text-sm md:text-xs font-semibold text-[9px] w-[25%] border-r border-[#E0E0E0]">Nomor WhatsApp</th>
                            <th class="p-[10px] text-left lg:text-sm md:text-xs font-semibold text-[9px] w-[25%]">Tanggal Berakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- User data rows -->
                        <tr class="border-b border-[#E0E0E0]">
                            <td class="lg:p-[10px] w-[25%] lg:text-sm md:text-xs text-[9px] border-r border-[#E0E0E0]">Muhammad Zidan Tifanno Nurfidausyi</td>
                            <td class="lg:p-[10px] w-[25%] lg:text-sm md:text-xs text-[9px] border-r border-[#E0E0E0]">Data 2</td>
                            <td class="lg:p-[10px] w-[25%] lg:text-sm md:text-xs text-[9px] border-r border-[#E0E0E0]">Data 3</td>
                            <td class="lg:p-[10px] w-[25%] lg:text-sm md:text-xs text-[9px]">Data 4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Right Column: Notification List -->
    <div class="space-y-[20px]">
        <div class="bg-white rounded-[20px] p-[20px] flex flex-col  overflow-y-auto ">
            <div class="flex items-center justify-between mb-[12px]">
                <div class="flex items-center space-x-4">
                    <img src="../assets/img/ic_notification.svg" alt="Notification Icon" class="lg:w-6 lg:h-6 w-4 h-4">
                    <h2 class="lg:text-lg font-bold text-sm">Notification</h2>
                </div>
            </div>
            <div class="space-y-2">
                <!-- Notification items -->
                <!-- Example of a single item -->
                <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                    <div>
                        <h2 class="hidden lg:inline font-semibold text-[12px]">Insert Data</h2>
                        <h2 class="lg:font-light md:font-semibold sm:font-semibold font-semibold text-[10px]">User data uploaded successfully</h2>
                    </div>
                    <div class="flex items-center">
                        <span class="text-white lg:text-sm md:text-sm sm:text-sm text-xs border border-grey-300 rounded-full px-2 py-1 bg-green-600">  Success</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection