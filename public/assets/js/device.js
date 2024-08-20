document.addEventListener('DOMContentLoaded', function() {
    const addUserBtn = document.getElementById('add-user-btn');
    const addUserPopup = document.getElementById('add-device-popup');
    const closePopupBtn = document.getElementById('popup-close');
    const connectionPopup = document.getElementById('connect-device-popup');
    const deletePopup = document.getElementById('delete-device-popup');

    // Fungsi untuk membuka popup
    function openPopup(popup) {
        popup.classList.remove('hidden');
    }

    // Fungsi untuk menutup popup
    function closePopup(popup) {
        popup.classList.add('hidden');
    }

    // Event listener untuk tombol "Add New Device"
    if (addUserBtn) {
        addUserBtn.addEventListener('click', function(event) {
            event.preventDefault();
            openPopup(addUserPopup);
        });
    }

    // Event listener untuk tombol close pada popup
    if (closePopupBtn) {
        closePopupBtn.addEventListener('click', function() {
            closePopup(addUserPopup);
        });
    }

    // Event delegation untuk tombol reconnect
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('reconnect-btn')) {
            event.preventDefault();
            const device = event.target.dataset.device;
            const token = event.target.dataset.token;
            
            console.log("Device (WhatsApp Number):", device);
            console.log("Token:", token);

            openPopup(connectionPopup);

            // Kirim permintaan untuk mendapatkan QR code
            fetch(`/devices/${device}/reconnect`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ token: token, whatsapp: device })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const img = new Image();
                    img.src = 'data:image/png;base64,' + data.qrUrl;
                    img.alt = 'QR Code';
                    img.classList.add('max-h-full', 'max-w-full');
                    document.getElementById('qr-code-container').innerHTML = '';
                    document.getElementById('qr-code-container').appendChild(img);
                } else {
                    alert('Failed to get QR code: ' + data.message);
                    closePopup(connectionPopup);
                }
            })
            .catch(error => {
                console.error("Error getting QR code:", error);
                alert('Error getting QR code');
                closePopup(connectionPopup);
            });
        }
    });

    // Event delegation untuk tombol delete
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-btn')) {
            event.preventDefault();
            const device = event.target.dataset.device;
            const token = event.target.dataset.token;

            // Kirim permintaan OTP
            fetch(`/devices/${device}/request-otp`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ token: token })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    openPopup(deletePopup);
                    document.getElementById('otp-device').value = device;
                    document.getElementById('otp-token').value = token;
                } else {
                    alert('Failed to request OTP: ' + data.message);
                }
            })
            .catch(error => {
                console.error("Error requesting OTP:", error);
                alert('Error requesting OTP');
            });
        }
    });

    // Event listener untuk submit form delete device
    const deleteDeviceForm = document.getElementById('deleteDeviceForm');
    if (deleteDeviceForm) {
        deleteDeviceForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const device = formData.get('device');

            fetch(`/devices/${device}/delete`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to delete device: ' + data.message);
                }
                closePopup(deletePopup);
            })
            .catch(error => {
                console.error("Error deleting device:", error);
                alert('Error deleting device');
            });
        });
    }

    // Event listener untuk menutup popup saat mengklik di luar
    [addUserPopup, connectionPopup, deletePopup].forEach(function(popup) {
        if (popup) {
            popup.addEventListener('click', function(event) {
                if (event.target === popup) {
                    closePopup(popup);
                }
            });
        }
    });

    // Event listener untuk tombol Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closePopup(addUserPopup);
            closePopup(connectionPopup);
            closePopup(deletePopup);
        }
    });

    // Event listener untuk tombol "Selesai" pada popup reconnect
    const deviceConnectionSelesai = document.getElementById('device-connection-selesai');
    if (deviceConnectionSelesai) {
        deviceConnectionSelesai.addEventListener('click', function() {
            location.reload();
        });
    }
});