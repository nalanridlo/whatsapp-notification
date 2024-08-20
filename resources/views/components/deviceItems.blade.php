<!-- deviceItems.blade.php -->
<div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
    <!-- Text Section -->
    <div class="flex flex-col justify-center space-y-1">
        <h2 class="font-semibold text-[16px]">{{ $device['name'] }}</h2>
        <h2 class="font-light text-[12px]">{{ $device['status'] }}</h2>
        <h2>{{ $token }}</h2>
    </div>

    <!-- Device Status -->
    <div class="flex items-center space-x-2">
        <span class="text-black text-sm">Status: </span>
        @if ($device['status'] === 'connect')
        <span class="text-green-600 text-sm">Connected</span>
        <span class="h-3 w-3 bg-green-600 rounded-full"></span>
        @else
        <span class="text-[#D00000] text-sm">Disconnected</span>
        <span class="h-3 w-3 bg-[#D00000] rounded-full"></span>
        @endif
    </div>

    <!-- Actions Buttons -->
    <div class="flex space-x-2">
        @if ($device['status'] === 'connect')
        <form action="{{ route('device.disconnect', ['device' => $device['device']]) }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#D00000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                Disconnect
            </button>
        </form>
        @else
        <button type="button"  class="reconnect-btn inline-flex items-center px-4 py-2 bg-[#7DDF64] text-white text-xs font-semibold rounded-lg hover:bg-blue-700"
            data-device="{{ $device['device'] }}"
            data-token="{{ $token }}">
            Reconnect
        </button>
        @endif
        <button type="button"  class="delete-btn px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-gray-800"
            data-device="{{ $device['device'] }}"
            data-token="{{ $token }}">
            Delete
        </button>
    </div>
</div>

<x-inputOtp :device="$device" :token="$token" />

<x-reconnect :device="$device" :token="$token" />

<!-- <script>
    $(document).ready(function() {
        // Ketika tombol delete diklik
        $('.delete-btn').click(function() {
            var device = $(this).data('device');
            var token = $(this).data('token');
            // Lakukan request OTP secara asynchronous
            $.ajax({
                url: "{{ route('devices.requestOtp', ['device' => $device['device']]) }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    token: '{{ $token }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Show OTP input modal
                        $('#delete-device-popup').removeClass('hidden');
                        // Set the device and token in the form
                        $('#otp-device').val(device);
                        $('#otp-token').val(token);
                    } else {
                        alert('Failed to request OTP: ' + response.message);
                    }
                },
                error: function(xhr) {
                    // Tangani error (misalnya beri notifikasi ke pengguna)
                    console.error(xhr);
                    alert('Error requesting OTP');
                }
            });
        });

        // Ketika tombol submit OTP diklik
        $(document).ready(function() {
            // Ketika tombol submit OTP diklik
            $('#submitOtpBtn').click(function(e) {
                e.preventDefault(); // Mencegah form dari submit normal
                var otp = $('#otp').val();
                var device = $('#otp-device').val();
                var token = $('#otp-token').val();

                // Logika untuk submit OTP ke server secara asynchronous
                $.ajax({
                    url: "{{ route('devices.delete', $device) }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        otp: otp,
                        token: token
                    },
                    success: function(response) {
                        if (response.success) {

                            window.location.reload(); // Reload the page to reflect changes
                        } else {

                        }
                        $('#delete-device-popup').addClass('hidden');
                    },
                    error: function(xhr) {
                        console.error(xhr);

                    }
                });
            });
        });
        $('.connection-btn').click(function() {
            var device = $(this).data('device'); // Nomor WhatsApp
            var token = $(this).data('token');

            console.log("Device (WhatsApp Number):", device);
            console.log("Token:", token);

            // Tampilkan pop-up reconnect
            $('#connect-device-popup').removeClass('hidden');

            // Kirim permintaan untuk mendapatkan QR code
            $.ajax({
                url: "{{ route('devices.reconnect', ['device' => $device['device']]) }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    token: token,
                    whatsapp: device
                },
                success: function(response) {
                    console.log(response.qrUrl)
                    if (response.success) {
                        // Tampilkan QR code
                        var img = new Image();
                        img.src = 'data:image/png;base64,' + response.qrUrl;
                        img.alt = 'QR Code'; // Menambahkan atribut alt untuk aksesibilitas
                        img.classList.add('max-h-full', 'max-w-full'); // Menambahkan class untuk memastikan gambar sesuai dengan container
                        $('#qr-code-container').empty(); // Kosongkan container sebelum menambahkan gambar baru
                        $('#qr-code-container').append(img);

                    } else {
                        alert('Failed to get QR code: ' + response.message);
                        $('#connect-device-popup').addClass('hidden');
                    }
                },
                error: function(xhr) {
                    console.error("Error getting QR code:", xhr);
                    alert('Error getting QR code');
                    $('#connect-device-popup').addClass('hidden');
                }
            });
        });
    });
    $('#popup-close').click(function() {
        $('#connect-device-popup').addClass('hidden');
    });
    $('#device-connection-selesai').click(function() {
        location.reload();
    });
</script> -->