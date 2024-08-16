<div id="add-user-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-[20px] shadow-lg p-8 w-[400px] space-y-6 p-[20px]">
        <!-- Title and Icon -->
        <div class="flex items-center space-x-4 mb-[20px]">
            <img src="../assets/img/ic_users_add-black.svg" alt="Users Icon" class="w-6 h-6">
            <h2 class="text-xl font-bold">Tambah Pengguna</h2>
        </div>
        <form method="POST" action="{{ route('users.storeUsers') }}">
            @csrf
            <!-- Form Name -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" placeholder="Nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- Form Birthdate -->
            <div class="mb-4">
                <label for="tanggalLahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggalLahir" id="tanggalLahir" placeholder="Tanggal Lahir" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- Form Number -->
            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                <input type="text" name="phone_number" id="phone_number" placeholder="Nomor WhatsApp" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- Form Expired Date -->
            <div class="mb-4">
                <label for="reminder_date" class="block text-sm font-medium text-gray-700">Tanggal Berakhir</label>
                <input type="date" name="reminder_date" id="reminder_date" placeholder="Tanggal Berakhir" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="expire_date" class="block text-sm font-medium text-gray-700">Tanggal Berakhir</label>
                <input type="date" name="expire_date" id="expire_date" placeholder="Tanggal Berakhir" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- Submit Button -->
            <div id="submit-btn" class="flex justify-end">
                <button class="bg-[#02182B] hover:bg-gray-800 w-full text-white font-bold py-2 px-4 rounded-[10px] focus:outline-none focus:shadow-outline drop-shadow-[0_4px_0_rgba(0,0,0,0.25)]"
                type="submit">Tambahkan</button>
            </div>
        </form>
    </div>
</div>