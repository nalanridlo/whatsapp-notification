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

//SideBar navigation
document.addEventListener('DOMContentLoaded', function() {
    function updateSidebarActiveState(url) {
        // Remove the active class from all sidebar links
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.classList.remove('text-[#0157FE]', 'font-bold');
            link.classList.add('text-[#878787]');

            // Update the icon if needed
            const img = link.querySelector('img');
            if (img) {
                img.src = img.src.replace('-active', '');
            }
        });

        // Add the active class to the matching link
        const matchingLink = document.querySelector(`.sidebar-link[href="${url}"]`);
        if (matchingLink) {
            matchingLink.classList.add('text-[#0157FE]', 'font-bold');
            matchingLink.classList.remove('text-[#878787]');

            const img = matchingLink.querySelector('img');
            if (img) {
                img.src = img.src.replace('.svg', '-active.svg');
            }
        }
    }

    function fetchContent(url) {
        fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.text())
            .then(html => {
                // Parse the HTML to get the content only
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.querySelector('#main-content').innerHTML;
                const newUrl = new URL(url, window.location.origin).href;

                // Update the main content
                document.querySelector('#main-content').innerHTML = newContent;

                // Update the URL
                history.pushState(null, '', newUrl);

                // Update the sidebar active state
                updateSidebarActiveState(newUrl);
            })
            .catch(error => console.error('Error loading content:', error));
    }

    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            fetchContent(this.href);
        });
    });

    // Handle browser navigation (back/forward)
    window.addEventListener('popstate', function() {
        fetchContent(location.href);
    });
});