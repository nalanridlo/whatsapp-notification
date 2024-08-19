<div id="logout-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-[#02182B] p-[20px] rounded-[20px] flex flex-col items-center space-y-4">
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
        <div class="flex justify-center">
            <dotlottie-player src="https://lottie.host/99c4626d-5176-4ccf-8025-24ed34dc37e5/wyicw1LXhn.json" background="transparent" speed="1" style="width: 400px; height: 200px" direction="1" playMode="normal" loop controls autoplay></dotlottie-player>
        </div>
        <div class="text-center">
            <h2 class="text-[20px] font-semibold text-white mx-[10px]">Apakah Anda Yakin untuk Keluar?</h2>
            <h4 class="text-[14px] text-[#F7F7F7] mb-[20px]">Anda Akan di redirect ke Login Page.</h4>
        </div>
        <div class="flex space-x-4 w-full">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-[#D00000] text-white font-semibold text-[14px] px-4 py-[15px] rounded-[10px] hover:bg-[#b00000]">Log Out</button>
            </form>
            <button id="popup-close" class="w-full  bg-[#0157FE] text-white font-semibold px-4 py-[10px] rounded-[10px] hover:bg-[#0240B9]">Batal</button>
        </div>
    </div>
</div>