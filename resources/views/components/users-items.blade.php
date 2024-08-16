<tr class="border-b border-[#E0E0E0] group">
    <td class="p-[10px] w-[25%] border-r border-[#E0E0E0] relative">
        <!-- Container for Buttons and Text -->
        <div class="flex items-center space-x-2">
            <!-- Button Container (initially hidden) -->
            <div class="absolute ml-[4px] left-0 top-1/2 transform -translate-y-1/2 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 ease-in-out z-10">
                <!-- More Options Button -->
                <button id="users-more-btn" class="rounded-full p-2 bg-gray-100 hover:bg-gray-200">
                    <svg fill="#000000" class="w-[24px] h-[24px]" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6,5H16a2,2,0,0,1,2,2v7" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                        <path d="M18,19H8a2,2,0,0,1-2-2V10" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                        <polyline points="15 11 18 14 21 11" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline>
                        <polyline points="9 13 6 10 3 13" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline>
                    </svg>
                </button>

                <!-- Delete Button -->
                <button id="users-delete-btn" class="rounded-full p-2 bg-[#D00000] hover:bg-[#b00000]">
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