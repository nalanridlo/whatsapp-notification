<div id="add-user-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-[20px] shadow-lg p-8 w-[400px] space-y-6 p-[20px]">
        <!-- Title and Icon -->
        <div class="flex items-center space-x-4">
            <img src="../assets/img/ic_users_add-black.svg" alt="Users Icon" class="w-6 h-6">
            <h2 class="text-xl font-bold">Tambah Pengguna</h2>
        </div>
        <!-- Form Name -->
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <!-- Form Birthdate -->
        <div>
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <!-- Form Number -->
        <div>
            <label for="nomor_whatsapp" class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
            <input type="text" id="nomor_whatsapp" name="nomor_whatsapp" placeholder="Nomor WhatsApp" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <!-- Form Expired Date -->
        <div>
            <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-700">Tanggal Berakhir</label>
            <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" placeholder="Tanggal Berakhir" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <!-- Submit Button -->
        <div class="flex justify-end">
            <button class="bg-[#02182B] hover:bg-gray-800 w-full text-white font-bold py-2 px-4 rounded-[10px] focus:outline-none focus:shadow-outline drop-shadow-[0_4px_0_rgba(0,0,0,0.25)]"
            type="submit">Tambahkan</button>
        </div>
    </div>
</div>

