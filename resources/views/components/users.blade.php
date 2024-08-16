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
                                    <a id="add-user-btn" class="inline-flex items-center px-4 py-2 bg-[#0157FE] text-white text-[12px] font-semibold rounded-[10px] hover:bg-blue-700">
                                        <img class="w-[28px] h-[28px] mr-2" src="../assets/img/ic_users_add-white.svg">
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
                        <x-users-items />
                        <x-users-items />
                        <x-users-items />
                        <x-users-items />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<x-users-add />

<x-alert-confirmation id="alert-confirmation" title="Add New User" message="Are you sure you want to add this user?" />

<x-alert-deletion id="alert-deletion" title="Apakah Anda Yakin?" message="Apakah anda yakin ingin menhapus data ini?" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addUserBtn = document.getElementById('add-user-btn');
        const addUserPopup = document.getElementById('add-user-popup');
        const deleteUserBtn = document.querySelectorAll('.users-delete-btn');
        const submitUserBtn = document.getElementById('submit-btn');
        const alertConfirmation = document.getElementById('alert-confirmation');
        const deleteConfirmation = document.getElementById('alert-deletion');
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

        // Show Confirmation Alert before Submiting
        submitUserBtn.addEventListener('click', function(event) {
            event.preventDefault();
            alertConfirmation.classList.remove('hidden');
        });

        // Show delete confirmation alert before deleting
        deleteUserBtn.forEach(function(deleteUserBtn) {
            deleteUserBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default action
                // Show delete confirmation alert
                deleteConfirmation.classList.remove('hidden');
            });
        });
    });
</script>
@endsection