@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
<div class="grid grid-cols-2 gap-[20px]">
    <!-- Left Column: Device Connected and Users List -->
    <div class="space-y-[20px]">
        <!-- Card 1: Device Connected List -->
        <div class="bg-white rounded-[20px] p-[20px] border-[3px] border-[#0157FE] max-h-[200px] overflow-y-auto">
            <div class="flex items-center justify-between mb-[12px]">
                <div class="flex items-center space-x-2">
                    <img src="../assets/img/ic_devices_card.svg" alt="Devices Icon" class="w-6 h-6">
                    <h2 class="text-lg font-bold">All Device</h2>
                    <!-- Device counter -->
                    <h2 class="text-lg font-bold">(2)</h2>
                </div>
                <a href="#" class="text-[#0157FE] text-xs underline font-semibold font-inter">Show More</a>
            </div>
            <!-- Device items -->
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <div class="text-sm font-semibold">Admin 1 - 08686849694968</div>
                    <div class="flex items-center">
                        <span class="text-green-600 text-sm">Connected</span>
                        <span class="ml-2 h-3 w-3 bg-green-600 rounded-full"></span>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-sm font-semibold">Admin 2 - 08686849694968</div>
                    <div class="flex items-center">
                        <span class="text-red-600 text-sm">Disconnected</span>
                        <span class="ml-2 h-3 w-3 bg-red-600 rounded-full"></span>
                    </div>
                </div>
                <!-- Add more items, but will only show 3 -->
                <div class="flex justify-between items-center">
                    <div class="text-sm font-semibold text-gray-400">Admin 3 - 08686849694968</div>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-400">Disconnected</span>
                        <span class="ml-2 h-3 w-3 bg-gray-400 rounded-full"></span>
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
                                        <img src="../assets/img/ic_users_card.svg" alt="Users Icon">
                                        <h2 class="text-xl font-bold">Users List</h2>
                                    </div>
                                    <a href="" class="text-[#0157FE] text-[12px] underline font-semibold font-['Inter']">Manage Users</a>
                                </div>
                            </th>
                        </tr>
                        <tr class="border-b border-[#E0E0E0]">
                            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Nama</th>
                            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Tanggal Lahir</th>
                            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Nomor WhatsApp</th>
                            <th class="p-[10px] text-left text-sm font-semibold w-[25%]">Tanggal Berakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- User data rows -->
                        <tr class="border-b border-[#E0E0E0]">
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 1</td>
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 2</td>
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 3</td>
                            <td class="p-[10px] w-[25%]">Data 4</td>
                        </tr>

                        <tr class="border-b border-[#E0E0E0]">
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 1</td>
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 2</td>
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 3</td>
                            <td class="p-[10px] w-[25%]">Data 4</td>
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
                    <img src="../assets/img/ic_notification.svg" alt="Notification Icon">
                    <h2 class="text-xl font-bold">Notification</h2>
                </div>
            </div>
            <div class="space-y-2">
                <!-- Notification items -->
                <!-- Example of a single item -->
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
                <!-- Repeat notification items as needed -->
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
            </div>
        </div>
    </div>
</div>
@endsection