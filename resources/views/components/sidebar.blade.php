<div class="w-[160px] bg-[#FFFFFF] p-4">
    <ul class="text-black space-y-4">
        <li class="flex items-center">
            <a href="{{ route('dashboard') }}" class="sidebar-link block py-2 px-4 flex items-center 
                {{ $activePage === 'dashboard' ? 'text-[#0157FE] font-bold' : 'text-[#878787]' }} text-[14px]">
                <img class="mr-2" src="{{ asset($activePage === 'dashboard' ? 'assets/img/ic_dashboard-active.svg' : 'assets/img/ic_dashboard.svg') }}" alt="Dashboard Icon">
                Dashboard
            </a>
        </li>
        <li class="flex items-center">
            <a href="{{ route('users') }}" class="sidebar-link block py-2 px-4 flex items-center 
                {{ $activePage === 'users' ? 'text-[#0157FE] font-bold' : 'text-[#878787]' }} text-[14px]">
                <img class="mr-2" src="{{ asset($activePage === 'users' ? 'assets/img/ic_users-active.svg' : 'assets/img/ic_users.svg') }}" alt="Users Icon">
                Users
            </a>
        </li>
        <li class="flex items-center">
            <a href="{{ route('device') }}" class="sidebar-link block py-2 px-4 flex items-center 
                {{ $activePage === 'device' ? 'text-[#0157FE] font-bold' : 'text-[#878787]' }} text-[14px]">
                <img class="mr-2" src="{{ asset($activePage === 'device' ? 'assets/img/ic_devices-active.svg' : 'assets/img/ic_devices.svg') }}" alt="Devices Icon">
                Devices
            </a>
        </li>
        <hr class="my-4 border-[#D0D0D0] -mx-4" />
        <li class="flex items-center ">
            <a href="#" class="flex items-center block py-2 px-4 text-[#878787] font-medium text-[14px] flex items-center">
                <img class="mr-2" src="../assets/img/ic_logout.svg">
                Logout
            </a>
        </li>
    </ul>
</div>