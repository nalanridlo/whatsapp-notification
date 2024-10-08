<div id="connect-device-popup" class="fixed inset-0 bg-black bg-opacity-20 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-[20px] shadow-lg w-full max-w-md p-[20px]">
        <!-- Title -->
        <div class="flex items-center space-x-4 mb-[20px]">
            <h2 class="text-xl font-bold">Reconnect Device</h2>
        </div>
        <!-- Content -->
        <div class="flex justify-center">
            <div id="qr-code-container" class="flex justify-center items-center h-64">
                <p>Loading QR Code...</p>
            </div>
        </div>
        <div>
            <button id="device-connection-selesai"
                class="bg-[#02182B] hover:bg-gray-800 w-full text-white font-bold py-2 px-4 rounded-[10px] focus:outline-none focus:shadow-outline drop-shadow-[0_4px_0_rgba(0,0,0,0.25)]" type="submit">
                Selesai
            </button>
        </div>
    </div>
</div>