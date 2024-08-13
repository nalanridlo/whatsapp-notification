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
    <x-header />
    <div class="flex h-screen">
        <!-- left navigation -->
        <x-sidebar :activePage="$activePage ?? 'dashboard'" />
        <!-- main content -->
        <main id="main-content" class="flex-1 bg-[#ECF0F5] p-[20px]">
            @yield('content')
        </main>
    </div>
    <x-alert-logout />
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutTrigger = document.getElementById('logout-trigger');
            const logoutPopup = document.getElementById('logout-popup');
            const closeButton = document.getElementById('popup-close');

            // Show the popup
            logoutTrigger.addEventListener('click', function(event) {
                event.preventDefault();
                logoutPopup.classList.remove('hidden');
            });

            // Hide the popup
            closeButton.addEventListener('click', function() {
                logoutPopup.classList.add('hidden');
            });
        });
    </script>
</body>

</html>