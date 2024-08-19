<!-- deviceItems.blade.php -->
<div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
    <!-- Text Section -->
    <div class="flex flex-col justify-center space-y-1">
        <h2 class="font-semibold text-[16px]">{{ $device['name'] }}</h2>
        <h2 class="font-light text-[12px]">{{ $device['device'] }}</h2>
        <h2 class="hidden">{{ $token }}</h2>
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
        <form action="{{ route('devices.disconnect', ['device' => $device['device']]) }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#D00000] text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                Disconnect
            </button>
        </form>
        @else
        <button type="button" id="connection-btn" class=" inline-flex items-center px-4 py-2 bg-[#7DDF64] text-white text-xs font-semibold rounded-lg hover:bg-blue-700"
            data-device="{{ $device['device'] }}"
            data-token="{{ $token }}">
            Reconnect
        </button>
        @endif
        <button type="button" class="delete-btn px-4 py-2 bg-[#000000] text-white text-xs font-semibold rounded-lg hover:bg-gray-800"
            data-device="{{ $device['device'] }}"
            data-token="{{ $token }}">
            Delete
        </button>
    </div>

    <x-device-action-delete :device="$device" :token="$token" />

    <x-device-action-connection :device="$device" :token="$token" />

</div>

<script>
    $(document).ready(function() {
        // Using event delegation to handle click events
        $(document).on('click', '.delete-btn', function() {
            var device = $(this).data('device');
            var token = $(this).data('token');

            // Construct the URL dynamically
            var url = "{{ route('devices.requestOtp', ['device' => ':device']) }}";
            url = url.replace(':device', device);

            // Make an asynchronous request to get the OTP
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    token: token
                },
                success: function(response) {
                    if (response.success) {
                        // Show OTP input modal
                        $('#delete-device-popup').removeClass('hidden');
                        // Set the device and token in the form
                        $('#otp-device').val(device);
                        $('#otp-token').val(token);
                    } else {
                        alert('Error: Unable to process the request.');
                    }
                },
                error: function(xhr) {
                    // Handle the error (e.g., notify the user)
                    console.error(xhr);
                    $('#delete-device-popup').addClass('hidden');
                }
            });
        });
    });

    $(document).ready(function() {
        // Ketika tombol submit OTP diklik
        $(document).on('click', '#submitOtpBtn', function(e) {
            e.preventDefault(); // Mencegah form dari submit normal
            var otp = $('#otp').val();
            var device = $('#otp-device').val();
            var token = $('#otp-token').val();

            // Logika untuk submit OTP ke server secara asynchronous
            var url = "{{ route('devices.delete', ':device') }}";
            url = url.replace(':device', device);

            $.ajax({
                url: url,
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
                        alert('Error: Unable to delete device.');
                    }
                    $('#delete-device-popup').addClass('hidden');
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Error: Something went wrong.');
                }
            });
        });
    });

    $(document).ready(function() {
        // Tombol connection di klik
        $(document).on('click', '#connection-btn', function() {
            var device = $(this).data('device'); // Nomor WhatsApp
            var token = $(this).data('token');

            console.log("Device (WhatsApp Number):", device);
            console.log("Token:", token);

            // Tampilkan pop-up reconnect
            $('#connect-device-popup').removeClass('hidden');

            // Kirim permintaan untuk mendapatkan QR code
            var url = "{{ route('devices.reconnect', ':device') }}";
            url = url.replace(':device', device);

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    token: token,
                    whatsapp: device
                },
                success: function(response) {
                    console.log(response.qrUrl);
                    if (response.success) {
                        // Tampilkan QR code
                        var img = new Image();
                        img.src = 'data:image/png;base64,' + response.qrUrl;
                        img.alt = 'QR Code'; // Menambahkan atribut alt untuk aksesibilitas
                        img.classList.add('max-h-full', 'max-w-full'); // Menambahkan class untuk memastikan gambar sesuai dengan container
                        $('#qr-code-container').empty(); // Kosongkan container sebelum menambahkan gambar baru
                        $('#qr-code-container').append(img);
                    } else {
                        $('#connect-device-popup').addClass('hidden');
                        alert('Error: Unable to connect device.');
                    }
                },
                error: function(xhr) {
                    console.error("Error getting QR code:", xhr);
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

    //fucntional
    document.addEventListener('DOMContentLoaded', function() {
        const addUserBtn = document.getElementById('add-user-btn');
        const addUserPopup = document.getElementById('add-device-popup');
        const closePopupBtn = document.getElementById('popup-close');
        //connection button
        const reconnectBtn = document.querySelectorAll('#connection-btn');
        //delete button
        const deleteBtn = document.querySelectorAll('.delete-btn');
        const connectionPopup = document.getElementById('connect-device-popup');
        const deletePopup = document.getElementById('delete-device-popup');

        deleteBtn.forEach(function(deleteDeviceBtn) {
            deleteDeviceBtn.addEventListener('click', function(event) {
                event.preventDefault();
                deletePopup.classList.remove('hidden');
            });
        });

        reconnectBtn.forEach(function(reconnectDeviceBtn) {
            reconnectDeviceBtn.addEventListener('click', function(event) {
                event.preventDefault();
                connectionPopup.classList.remove('hidden');
            });
        });


        // Open the popup when the button is clicked
        addUserBtn.addEventListener('click', function(event) {
            event.preventDefault();
            addUserPopup.classList.remove('hidden');
        });


        connectionPopup.addEventListener('click', function(event) {
            if (event.target === connectionPopup) {
                connectionPopup.classList.add('hidden');
            }
        });

        deletePopup.addEventListener('click', function(event) {
            if (event.target === deletePopup) {
                deletePopup.classList.add('hidden');
            }
        });

        // Close the popup when the close button is clicked
        closePopupBtn.addEventListener('click', function() {
            addUserPopup.classList.add('hidden');
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                addUserPopup.classList.add('hidden');
            }
        });

        // Close the popup when clicking outside the main card
        addUserPopup.addEventListener('click', function(event) {
            if (event.target === addUserPopup) {
                addUserPopup.classList.add('hidden');
            }
        });

    });
</script>