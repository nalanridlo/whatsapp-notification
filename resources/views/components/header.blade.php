<header class="bg-[#ECF0F5] flex flex-col items-center w-full box-sizing-border">
    <nav class="bg-[#0157FE] relative flex flex-row justify-between w-full box-sizing-border p-[20px]">
        <div class="flex-1 flex justify-center">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img class="w-[216px] h-[64px]" src="{{ asset('assets/img/AffidavitLogo.svg') }}" alt="Logo">
            </a>
        </div>

        <div class="relative flex items-center">
            <div class="w-[50px] h-[50px] rounded-full overflow-hidden border-2 border-white flex items-center justify-center">
                <img class="w-full h-full object-cover cursor-pointer" src="{{ asset('assets/img/UserVector.svg') }}" alt="icon_user" id="user-icon">
            </div>
            <!-- Dropdown Menu -->
            <div id="dropdown-menu" class="hidden absolute right-0 top-full p-[20px] w-auto bg-white shadow-lg rounded-[10px] z-10 flex">
                <!-- Dropdown Items -->
                <div class="flex-1 flex flex-col justify-center px-4 py-2">
                    <p class="text-[16px] font-semibold text-black" id="user-name">akmal ali</p>
                    <p class="text-[12px] text-gray-600" id="user-email">akmal@gmail.com</p>
                </div>
                <!-- User Picture -->
                <div class="flex-shrink-0 w-16 h-full flex items-center justify-center">
                    <img class="w-[50px] h-[50px] rounded-full object-cover" src="../assets/img/UserVector.svg" alt="User Picture">
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('click', function(event) {
        const userIcon = document.getElementById('user-icon');
        const dropdownMenu = document.getElementById('dropdown-menu');

        if (userIcon && userIcon.contains(event.target)) {
            dropdownMenu.classList.toggle('hidden');
        } else if (!dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>