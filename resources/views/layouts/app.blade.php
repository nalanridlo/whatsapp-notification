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
        <x-sidebar />
        <!-- main content -->
        <main id="main-content" class="flex-1 bg-[#ECF0F5] overflow-auto p-5 transition-all duration-300 ease-in-out">
            @yield('content')
        </main>
    </div>
    <x-alert-logout />
    <script src="../assets/js/sidebar.js"></script>
</body>

</html>