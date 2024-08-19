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
    rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  @notifyCss
</head>

<body class="bg-[#F7FAFF] flex items-center justify-center h-screen">
  <x-notify::notify />
  @notifyJs
  <div class="bg-[#0157FE] p-8 rounded-[20px] shadow-md w-96">
    <div class="flex justify-center mb-4">
      <img
        class="w-[112px] h[112px]"
        src="../assets/img/logo_login.png"
        alt="Logo"
        class="h-12" />
    </div>

    <h2 class="text-white text-2xl font-semibold">
      Selamat Datang di Affidavit!
    </h2>

    <div class="flex items-center mb-2">
      <img
        class="w-[10px] h-[13.13px]"
        src="../assets/img/lockLogo.png" />
      <p class="text-white text-[16px] font-light ml-1.5">Admin Login</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-4">
        <label for="email" class="block text-white text-[14px] font-regular mb-1">
          Email
        </label>
        <input
          type="email"
          id="email"
          name="email"
          required
          class="shadow appearance-none border rounded-[10px] w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Email" />
      </div>
      <div class="mb-6">
        <label for="password" class="block text-white text-[14px] font-regular mb-1">
          Password
        </label>
        <input
          type="password"
          id="password"
          name="password"
          required
          class="shadow appearance-none border rounded-[10px] w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Password" />
      </div>
      <div class="flex items-center">
        <button
          class="bg-[#02182B] hover:bg-gray-800 w-full text-white font-bold py-2 px-4 rounded-[10px] focus:outline-none focus:shadow-outline drop-shadow-[0_4px_0_rgba(0,0,0,0.25)]"
          type="submit">
          Masuk
        </button>
      </div>
    </form>

  </div>
</body>

</html>