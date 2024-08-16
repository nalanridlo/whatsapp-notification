//Header
document.addEventListener('click', function(event) {
    const userIcon = document.getElementById('user-icon');
    const dropdownMenu = document.getElementById('dropdown-menu');

    if (userIcon && userIcon.contains(event.target)) {
        dropdownMenu.classList.toggle('hidden');
    } else if (!dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
    }
});

//Log Out Pop Up
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

document.getElementById('hamburger-btn').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    var main = document.getElementById('main-content');
    sidebar.classList.toggle('hidden');
    sidebar.classList.toggle('absolute');
    sidebar.classList.toggle('top-full');

    main.classList.toggle('hidden');
});