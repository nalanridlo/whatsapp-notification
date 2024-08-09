<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-[#F7FAFF] flex items-center justify-center h-screen">
    <div class="bg-[#0157FE] p-8 rounded-lg shadow-md w-96">
      <div class="flex justify-center mb-4">
        <img
          class="w-[112px] h[112px]"
          src="../assets/img/logo_login.png"
          alt="Logo"
          class="h-12"
        />
      </div>

      <h2 class="text-white text-2xl font-semibold">
        Selamat Datang di Affidavit!
      </h2>
      <p class="text-white mb-4">Admin Login</p>

      <form method="POST" action="{{ route('login') }}">
  @csrf
  <div class="mb-4">
    <label for="username" class="block text-white text-sm font-bold mb-2">
      Username
    </label>
    <input
      type="text"
      id="username"
      name="username"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      placeholder="Username/Email"
    />
  </div>
  <div class="mb-6">
    <label for="password" class="block text-white text-sm font-bold mb-2">
      Password
    </label>
    <input
      type="password"
      id="password"
      name="password"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      placeholder="Password"
    />
  </div>
  <div class="flex items-center">
    <button
      class="bg-[#02182B] hover:bg-gray-100 w-full text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
      type="submit"
    >
      Masuk
    </button>
  </div>
</form>

      </div>
    </div>
  </body>
</html>
