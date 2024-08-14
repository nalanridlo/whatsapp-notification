<div id="add-device-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-[20px] shadow-lg w-full max-w-md p-[20px]">
        <!-- Title and Icon -->
        <div class="flex items-center space-x-4 mb-[20px]">
            <img src="../assets/img/ic_devices_card.svg" alt="Users Icon" class="w-6 h-6">
            <h2 class="text-xl font-bold">Add New Device</h2>
        </div>
        <form method="POST" action="{{}}">
            @csrf
            <!-- Form Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" placeholder="Nama" class="w-full p-2 border rounded-lg">
            </div>
            <!-- Form Number -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                <input type="text" placeholder="Nomor WhatsApp" class="w-full p-2 border rounded-lg">
            </div>
            <!-- Button Submit -->
            <div class="flex justify-end">
                <!-- form submit bellow -->
                <button class="bg-[#02182B] hover:bg-gray-800 w-full text-white font-bold py-2 px-4 rounded-[10px] focus:outline-none focus:shadow-outline drop-shadow-[0_4px_0_rgba(0,0,0,0.25)]"
                type="submit">
                Tambahkan
                </button>
            </div>
        </form>
    </div>
</div>
