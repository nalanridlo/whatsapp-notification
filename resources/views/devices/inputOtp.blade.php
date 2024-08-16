<!-- resources/views/devices/inputOtp.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input OTP</title>
</head>
<body>
<div class="container mx-auto mt-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="md:flex">
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Input OTP</div>
                <p class="mt-2 text-gray-500">Please enter the OTP sent to your WhatsApp to delete the device.</p>
                <form action="{{ route('devices.delete', $device) }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mt-4">
                        <label for="otp" class="block text-sm font-medium text-gray-700">OTP</label>
                        <input type="text" name="otp" id="otp" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Delete Device
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
