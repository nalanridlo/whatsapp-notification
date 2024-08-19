<div id="add-device-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-[20px] shadow-lg w-full max-w-md p-[20px]">
        <!-- Title and Icon -->
        <div class="flex items-center space-x-4 mb-[20px]">
            <img src="../assets/img/ic_devices_card.svg" alt="Users Icon" class="w-6 h-6">
            <h2 class="text-xl font-bold">Add New Device</h2>
        </div>
        <form method="POST" action="{{ route('devices.storeDevice') }}">
            @csrf
            <!-- Form Name -->
            <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Device Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-4">
            <label for="device" class="block text-sm font-medium text-gray-700">Device Number</label>
            <input type="text" name="device" id="device" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        
        <div id="submit-btn" class="flex justify-end">
                <button class="bg-[#02182B] hover:bg-gray-800 w-full text-white font-bold py-2 px-4 rounded-[10px] focus:outline-none focus:shadow-outline drop-shadow-[0_4px_0_rgba(0,0,0,0.25)]"
                type="submit">Tambahkan</button>
            </div>
            </div>
        </form>
    </div>
</div>