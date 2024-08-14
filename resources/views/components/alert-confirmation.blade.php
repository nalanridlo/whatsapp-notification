<div id="alert-confirmation" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-[#02182B] w-[410px] p-[20px] rounded-[20px] flex flex-col items-center space-y-4">
        <div class="text-center">
            <h2 class="text-[20px] font-semibold text-white mx-[10px]">{{ $title }}</h2>
            <p class="text-[14px] text-[#F7F7F7] mb-[20px]">{{ $message }}</h4>
        </div>
        <div class="flex space-x-4 w-full">
            <button type="submit-btn" class="w-full bg-[#7DDF64] text-white font-semibold text-[14px] px-4 py-[15px] rounded-[10px] hover:bg-[#b00000]">Sudah</button>
            <button id="popup-close-btn" class="w-full  bg-[#0157FE] text-white font-semibold px-4 py-[10px] rounded-[10px] hover:bg-[#0240B9]">Batal</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertConfirmation = document.getElementById('alert-confirmation');
        const submitBtn = document.getElementById('submit-btn');
        const closeBtn = document.getElementById('popup-close-btn');

        closeBtn.addEventListener('click', function() {
            alertConfirmation.classList.add('hidden');
        });
    });
</script>