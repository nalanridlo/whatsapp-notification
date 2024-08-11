<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Page </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Apply Inter font to entire document */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="bg-[#ECF0F5] flex flex-col items-center w-full box-sizing-border">
        <nav class="bg-[#0157FE] relative flex flex-row justify-between w-full box-sizing-border p-[20px]">
            <div class="flex-1 flex justify-center">
                <a href="#" class="flex items-center">
                    <img class="w-[216px] h-[64px]" src="../assets/img/AffidavitLogo.svg" alt="Logo">
                </a>
            </div>

            <div class="relative flex items-center">
                <div class="w-[50px] h-[50px] rounded-full overflow-hidden border-2 border-white flex items-center justify-center">
                    <img class="w-full h-full object-cover cursor-pointer" src="../assets/img/UserVector.svg" alt="icon_user" id="user-icon">
                </div>
                <!-- Dropdown Menu -->
                <div id="dropdown-menu" class="hidden absolute right-0 top-full p-[20px] w-auto bg-white shadow-lg rounded-[10px] z-10 flex">
                    <!-- Dropdown Items -->
                    <div class="flex-1 flex flex-col justify-center px-4 py-2">
                        <p class="text-[16px] font-semibold text-black" id="user-name">User Name</p>
                        <p class="text-[12px] text-gray-600" id="user-email">user@example.com</p>
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
        document.addEventListener('DOMContentLoaded', function() {
            const userIcon = document.getElementById('user-icon');
            const dropdownMenu = document.getElementById('dropdown-menu');

            userIcon.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent event bubbling
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
    <div class="flex h-screen">
        <div class="w-[160px] bg-[#FFFFFF] p-4">
            <ul class="text-black space-y-4">
                <li class="flex items-center">
                    <img class="" src="../assets/img/ic_round-dashboard.png">
                    <a href="#" class="block py-2 px-4 text-[#0157FE] font-bold ">Dashboard</a>
                </li>
                <li class="flex items-center">
                    <img class="" src="../assets/img/ic_users.svg">
                    <a href="#" class="block py-2 px-4 ">Users</a>
                </li>
                <li class="flex items-center">
                    <img class="" src="../assets/img/ic_devices.svg">
                    <a href="#" class="block py-2 px-4 ">Devices</a>
                </li>
                <hr class="my-4 border-gray-500" />
                <li class="flex items-center">
                    <img class="" src="../assets/img/ic_logout.svg">
                    <a href="#" class="block py-2 px-4 ">Logout</a>
                </li>
            </ul>
        </div>
        <main class="flex-1 bg-[#ECF0F5] p-[20px]">
            <div class="grid gap-[20px]">
                <div class="bg-white rounded-[20px] p-[20px] overflow-y-auto">
                    <div class="flex items-center justify-between mb-[12px]">
                        <div class="flex items-center space-x-2">
                            <img src="../assets/img/ic_devices_card.svg" alt="Devices Icon" class="w-6 h-6">
                            <h2 class="text-lg font-bold">All Device</h2>
                            <!-- Device counter -->
                            <h2 class="text-lg font-bold">(3)</h2>
                        </div>
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-[#0157FE] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Add New Device
                        </a>
                    </div>
                    <!-- Device items -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                            <!-- Text Section -->
                            <div class="flex flex-col justify-center space-y-1">
                                <h2 class="font-semibold text-[16px]">Admin</h2>
                                <h2 class="font-light text-[12px]">085394923893</h2>
                            </div>

                            <!-- Device Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-black text-sm">Status: </span>
                                <span class="text-green-600 text-sm">Connected</span>
                                <span class="h-3 w-3 bg-green-600 rounded-full"></span>
                            </div>

                            <!-- Actions Buttons -->
                            <div class="flex space-x-2">
                                <a href="#" class="inline-flex items-center px-4 py-2 bg-[#D00000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                                    Disconnect
                                </a>
                                <a href="#" class="inline-flex items-center px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                                    Delete
                                </a>
                            </div>
                        </div>
                        <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                            <!-- Text Section -->
                            <div class="flex flex-col justify-center space-y-1">
                                <h2 class="font-semibold text-[16px]">Admin</h2>
                                <h2 class="font-light text-[12px]">085394923893</h2>
                            </div>

                            <!-- Device Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-black text-sm">Status: </span>
                                <span class="text-[#D00000] text-sm">Disconnected</span>
                                <span class="h-3 w-3 bg-[#D00000] rounded-full"></span>
                            </div>

                            <!-- Actions Buttons -->
                            <div class="flex space-x-2">
                                <a href="#" class="inline-flex items-center px-4 py-2 bg-[#7DDF64] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                                    Connect
                                </a>
                                <a href="#" class="inline-flex items-center px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                                    Delete
                                </a>
                            </div>
                        </div>
                        <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                            <!-- Text Section -->
                            <div class="flex flex-col justify-center space-y-1">
                                <h2 class="font-semibold text-[16px]">Admin</h2>
                                <h2 class="font-light text-[12px]">085394923893</h2>
                            </div>

                            <!-- Device Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-black text-sm">Status: </span>
                                <span class="text-green-600 text-sm">Connected</span>
                                <span class="h-3 w-3 bg-green-600 rounded-full"></span>
                            </div>

                            <!-- Actions Buttons -->
                            <div class="flex space-x-2">
                                <a href="#" class="inline-flex items-center px-4 py-2 bg-[#D00000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                                    Disconnect
                                </a>
                                <a href="#" class="inline-flex items-center px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>