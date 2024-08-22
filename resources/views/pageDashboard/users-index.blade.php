<table class="min-w-full bg-[#FFFFFF] rounded-[20px] border-collapse">
    <thead class="bg-[#F5F5F5] rounded-[20px] sticky top-0 z-10">
        <tr class="border-b border-[#E0E0E0]">
            <th class="p-[10px] text-left text-sm font-semibold" colspan="4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="../assets/img/ic_users_card.svg" alt="Users Icon">
                        <h2 class="text-xl font-bold">Data ABG</h2>
                    </div>
                    <!-- buatlah route ke components.users -->
                    <a href="/users" class="text-[#0157FE] text-xs underline font-semibold">Manage User</a>
                </div>
            </th>
        </tr>
        <tr class="border-b border-[#E0E0E0]" >
            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Nama</th>
            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Tanggal Lahir</th>
            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Nomor WhatsApp</th>
            <th class="p-[10px] text-left text-sm font-semibold w-[25%]">Tanggal Berakhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reminders as $reminder)
        <tr class="border-b border-[#E0E0E0]">
            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">{{ $reminder->nama }}</td>
            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">{{ $reminder->tanggalLahir }}</td>
            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">{{ $reminder->phone_number }}</td>
            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">{{ $reminder->expire_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>