<div id="delete-device-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-[20px] shadow-lg w-full max-w-md">
        <div class="flex items-center space-x-4 mb-[20px]">
            <h2 class="text-xl font-bold">Delete Device</h2>
            <p class="text-xl font-regular">Masukkan OTP</p>
        </div>
        <form id="deleteDeviceForm">
            @csrf
            <input type="hidden" id="otp-device" name="device">
            <input type="hidden" id="otp-token" name="token">
            <div class="mt-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">OTP</label>
                <input type="text" name="otp" placeholder="Masukkan OTP.." id="otp" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="mt-6">
                <button type="button" id="submitOtpBtn" class="bg-[#02182B] hover:bg-gray-800 w-full text-white font-bold py-2 px-4 rounded-[10px] focus:outline-none focus:shadow-outline drop-shadow-[0_4px_0_rgba(0,0,0,0.25)]">
                    Delete Device
                </button>
            </div>
        </form>
    </div>
</div>