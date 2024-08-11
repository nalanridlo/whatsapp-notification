<!doctype html>
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
                <div class="grid grid-cols-2 gap-[20px]">
                    <!-- Left Column: Device Connected and Users List -->
                    <div class="space-y-[20px]">
                        <!-- Card 1: Device Connected List -->
                        <div class="bg-white rounded-[20px] p-[20px] border-[3px] border-[#0157FE] max-h-[200px] overflow-y-auto">
                            <div class="flex items-center justify-between mb-[12px]">
                                <div class="flex items-center space-x-2">
                                    <img src="../assets/img/ic_devices_card.svg" alt="Devices Icon" class="w-6 h-6">
                                    <h2 class="text-lg font-bold">All Device</h2>
                                    <!-- Device counter -->
                                    <h2 class="text-lg font-bold">(2)</h2>
                                </div>
                                <a href="#" class="text-[#0157FE] text-xs underline font-semibold font-inter">Show More</a>
                            </div>
                            <!-- Device items -->
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-semibold">Admin 1 - 08686849694968</div>
                                    <div class="flex items-center">
                                        <span class="text-green-600 text-sm">Connected</span>
                                        <span class="ml-2 h-3 w-3 bg-green-600 rounded-full"></span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-semibold">Admin 2 - 08686849694968</div>
                                    <div class="flex items-center">
                                        <span class="text-red-600 text-sm">Disconnected</span>
                                        <span class="ml-2 h-3 w-3 bg-red-600 rounded-full"></span>
                                    </div>
                                </div>
                                <!-- Add more items, but will only show 3 -->
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-semibold text-gray-400">Admin 3 - 08686849694968</div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-400">Disconnected</span>
                                        <span class="ml-2 h-3 w-3 bg-gray-400 rounded-full"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Users List -->
                        <div class="bg-white rounded-[20px] p-[20px] border-[3px] border-[#E0E0E0] max-h-[300px] overflow-y-auto">
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-[#FFFFFF] rounded-[20px] border border-[#E0E0E0]">
                                    <thead class="bg-[#F5F5F5] rounded-t-[20px]">
                                        <tr class="border-b border-[#E0E0E0]">
                                            <th class="p-[10px] text-left text-sm font-semibold" colspan="4">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-4">
                                                        <img src="../assets/img/ic_users_card.svg" alt="Users Icon">
                                                        <h2 class="text-xl font-bold">Users List</h2>
                                                    </div>
                                                    <a href="" class="text-[#0157FE] text-[12px] underline font-semibold font-['Inter']">Manage Users</a>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr class="border-b border-[#E0E0E0]">
                                            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Nama</th>
                                            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Tanggal Lahir</th>
                                            <th class="p-[10px] text-left text-sm font-semibold w-[25%] border-r border-[#E0E0E0]">Nomor WhatsApp</th>
                                            <th class="p-[10px] text-left text-sm font-semibold w-[25%]">Tanggal Berakhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- User data rows -->
                                        <tr class="border-b border-[#E0E0E0]">
                                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 1</td>
                                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 2</td>
                                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 3</td>
                                            <td class="p-[10px] w-[25%]">Data 4</td>
                                        </tr>
                                        
                                        <tr class="border-b border-[#E0E0E0]">
                                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 1</td>
                                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 2</td>
                                            <td class="p-[10px] w-[25%] border-r border-[#E0E0E0]">Data 3</td>
                                            <td class="p-[10px] w-[25%]">Data 4</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column: Notification List -->
                    <div class="space-y-[20px]">
                        <div class="bg-white rounded-[20px] p-[20px] flex flex-col  overflow-y-auto " >
                            <div class="flex items-center justify-between mb-[12px]">
                                <div class="flex items-center space-x-4">
                                    <img src="../assets/img/ic_notification.svg" alt="Notification Icon">
                                    <h2 class="text-xl font-bold">Notification</h2>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <!-- Notification items -->
                                <!-- Example of a single item -->
                                <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                                    <div>
                                        <h2 class="font-semibold text-[12px]">Insert Data</h2>
                                        <h2 class="font-light text-[10px]">User data uploaded successfully</h2>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-black text-sm">Status: </span>
                                        <span class="text-green-600 text-sm">Success</span>
                                        <span class="ml-2 h-3 w-3 bg-green-600 rounded-full"></span>
                                    </div>
                                </div>
                                <!-- Repeat notification items as needed -->
                                <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                                    <div>
                                        <h2 class="font-semibold text-[12px]">Insert Data</h2>
                                        <h2 class="font-light text-[10px]">User data uploaded successfully</h2>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-black text-sm">Status: </span>
                                        <span class="text-green-600 text-sm">Success</span>
                                        <span class="ml-2 h-3 w-3 bg-green-600 rounded-full"></span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                                    <div>
                                        <h2 class="font-semibold text-[12px]">Insert Data</h2>
                                        <h2 class="font-light text-[10px]">User data uploaded successfully</h2>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-black text-sm">Status: </span>
                                        <span class="text-green-600 text-sm">Success</span>
                                        <span class="ml-2 h-3 w-3 bg-green-600 rounded-full"></span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
                                    <div>
                                        <h2 class="font-semibold text-[12px]">Insert Data</h2>
                                        <h2 class="font-light text-[10px]">User data uploaded successfully</h2>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-black text-sm">Status: </span>
                                        <span class="text-green-600 text-sm">Success</span>
                                        <span class="ml-2 h-3 w-3 bg-green-600 rounded-full"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const userIcon = document.getElementById('user-icon');
                const dropdownMenu = document.getElementById('dropdown-menu');

                userIcon.addEventListener('click', function (event) {
                    event.stopPropagation(); // Prevent event bubbling
                    dropdownMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function (event) {
                    if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            });
        </script>
    </body>
</html>