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
                                        <form id="search-form" class="relative">
                                            <input type="search" name="search" id="search-input" placeholder="Search..." class="w-full p-2 pl-10 border border-gray-300 rounded-full">
                                            <button> 
                                                <img class="absolute top-1/3 left-3 transform -translate-y-1/2 w-5 h-5 text-gray-500" src="../assets/img/ic_search.svg" />
                                            </button>
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
                        @foreach($reminders as $reminder)
                        <tr class="border-b border-[#E0E0E0] group">
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0] relative">
                                <!-- Container for Buttons and Text -->
                                <div class="flex items-center space-x-2">
                                    <!-- Button Container (initially hidden) -->
                                    <div class="absolute ml-[4px] left-0 top-1/2 transform -translate-y-1/2 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 ease-in-out z-10">

                                        <!-- Delete Button items users -->
                                        <button id="" data-id="{{ $reminder->id }}" class="users-items rounded-full p-2 bg-[#D00000] hover:bg-[#b00000]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v10zm3.17-7.83c.39-.39 1.02-.39 1.41 0L12 12.59l1.42-1.42c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41L13.41 14l1.42 1.42c.39.39.39 1.02 0 1.41-.39.39-1.02.39-1.41 0L12 15.41l-1.42 1.42c-.39.39-1.02.39-1.41 0-.39-.39-.39-1.02 0-1.41L10.59 14l-1.42-1.42c-.39-.38-.39-1.02 0-1.41zM15.5 4l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1h-2.5z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                        
                                    <!-- Data Text -->
                                    <span class="ml-[50px] group-hover:ml-24 transition-all duration-200 ease-in-out">{{ $reminder->nama }}</span>
                                </div>
                            </td>
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">{{ $reminder->tanggalLahir }}</td>
                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">{{ $reminder->phone_number }}</td>
                            <td class="p-[10px] w-[25%]">{{ $reminder->expire_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-users-add />

<x-alert-confirmation id="alert-confirmation" />

<x-alert-deletion id="alert-deletion" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addUserBtn = document.getElementById('add-user-btn');
        const addUserPopup = document.getElementById('add-user-popup');
        // const deleteUserBtn = document.getElementById('users-delete-btn');
        const submitUserBtn = document.getElementById('submit-btn');
        const alertConfirmation = document.getElementById('alert-confirmation');
        const deleteConfirmation = document.getElementById('alert-deletion');
        const closePopupBtn = document.getElementById('popup-close-btn');

        const usersItems = document.querySelectorAll('.users-items');


        usersItems.forEach(function(deleteUsersBtn) {
            deleteUsersBtn.addEventListener('click', function(event) {
                event.preventDefault();
                deleteConfirmation.classList.remove('hidden');
            });
        });

        $(document).ready(function() {
            $('.users-items').on('click', function(e) {
                e.preventDefault();
                var $item = $(this).closest('tr');
                var reminderId = $(this).data('id');

                deleteConfirmation.classList.remove('hidden');

                // Add confirmation logic here
                const confirmDeleteBtn = deleteConfirmation.querySelector('button[type="submit-btn"]');
                const cancelDeleteBtn = deleteConfirmation.querySelector('#popup-close-btn');

                function hideDeleteConfirmation() {
                    deleteConfirmation.classList.add('hidden');
                    // Remove event listeners to prevent memory leaks
                    confirmDeleteBtn.removeEventListener('click', handleDelete);
                    cancelDeleteBtn.removeEventListener('click', hideDeleteConfirmation);
                }

                function handleDelete() {
                    $.ajax({
                        url: "{{ route('reminders.delete', ':id') }}".replace(':id', reminderId),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                $item.remove();

                            } else {
                                alert('Failed to delete reminder');
                            }
                            hideDeleteConfirmation();
                        },
                        error: function() {
                            alert('An error occurred while deleting the reminder');
                            hideDeleteConfirmation();
                        }
                    });
                }

                confirmDeleteBtn.addEventListener('click', handleDelete);
                cancelDeleteBtn.addEventListener('click', hideDeleteConfirmation);
            });
        });

    

        closePopupBtn.addEventListener('click', function() {
            deleteConfirmation.classList.add('hidden');
        });
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

        deleteUserBtn.addEventListener('click', function(event) {
            event.preventDefault();
            deleteConfirmation.classList.remove('hidden');
        });
    });
</script>
@endsection