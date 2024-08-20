<div id="delete-device-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-[20px] shadow-lg w-full max-w-md">
        <div class="flex items-center space-x-4 mb-[20px]">
            <h2 class="text-xl font-bold">Delete Device</h2>
        </div>
        <form id="deleteDeviceForm">
            @csrf
            <input type="hidden" id="otp-device" name="device">
            <input type="hidden" id="otp-token" name="token">
            <div class="mt-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">OTP</label>
                <input type="text" name="otp" id="otp" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="mt-6">
                <button type="submit" id="submitOtpBtn" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Delete Device
                </button>
            </div>
        </form>
    </div>
</div>

