<div id="delete-device-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-[20px] shadow-lg w-full max-w-md">
        <!-- Title -->
        <div class="flex flex-col items-start p-[20px]">
            <h2 class="text-xl font-bold mb-2">Delete Device</h2>
            <p class="text-xl font-regular">Masukkan OTP</p>
        </div>
        <!-- Content -->
        <form method="" action="" class="p-[20px] pt-0">
            <div class="mb-4">
                <input
                type="text"
                id="username"
                name="username"
                class="shadow appearance-none border rounded-[10px] w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="OTP" />
            </div>
            <div class="flex items-center">
                <button
                    class="bg-[#02182B] hover:bg-gray-800 w-full text-white font-bold py-2 px-4 rounded-[10px] focus:outline-none focus:shadow-outline drop-shadow-[0_4px_0_rgba(0,0,0,0.25)]"
                    type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>