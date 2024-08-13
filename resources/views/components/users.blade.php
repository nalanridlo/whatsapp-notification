@extends('layouts.app')

@section('title', 'users')

@section('content')
<div class="grid gap-[20px]">
    <div>
        <div class="bg-white rounded-[20px] p-[20px] overflow-y-auto">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-[#FFFFFF] rounded-[20px] border border-[#E0E0E0]">
                    <thead class="bg-[#F5F5F5] rounded-t-[20px]">
                        <tr class="border-b border-[#E0E0E0]">
                            <th class="p-[10px] text-left text-sm font-semibold" colspan="4">
                                <div class="flex items-center justify-between p-4">
                                    <!-- Title and Icon -->
                                    <div class="flex items-center space-x-4">
                                        <img src="../assets/img/ic_users_card.svg" alt="Users Icon" class="w-6 h-6">
                                        <h2 class="text-xl font-bold">Users List</h2>
                                    </div>

                                    <!-- Search Form -->
                                    <div class="flex-1 max-w-sm">
                                        <form class="relative">
                                            <input type="text" placeholder="Search..." class="w-full p-2 pl-10 border border-gray-300 rounded-full">
                                            <img class="absolute top-1/2 left-3 transform -translate-y-1/2 w-5 h-5 text-gray-500" src="../assets/img/ic_search.svg" />
                                        </form>
                                    </div>

                                    <!-- Button -->
                                    <a href="#" class="inline-flex items-center px-4 py-2 bg-[#0157FE] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                                        <img class="w-[28px] h-[28px] mr-2" src="../assets/img/ic_add_users.svg" >
                                        Add New Users
                                    </a>
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
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">
                                <div class="flex items-center space-x-2">
                                    <!-- More Options Button -->
                                    <button class="p-1 rounded-full hover:bg-gray-200">
                                        <img src="../assets/img/ic_more.svg" alt="More Options" class="w-5 h-5">
                                    </button>
                                    <!-- Data Text -->
                                    <span>Data 1</span>
                                </div>
                            </td>
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 2</td>
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 3</td>
                            <td class="p-[10px] w-[25%]">Data 4</td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection