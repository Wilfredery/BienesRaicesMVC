document.addEventListener('DOMContentLoaded', function() {
    eventListener();
    darkMode();
});

function eventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navResponsive);
}

function navResponsive() {
    const nav = document.querySelector('.navegacion');

    nav.classList.toggle('mostrar');
}

function darkMode() {
    const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if (localStorage.getItem('color-mode') === 'true') {
        document.body.classList.add('dark-mode');
      } else if (localStorage.getItem('color-mode') === 'false') {
        document.body.classList.remove('dark-mode');
      } else {
     
    // If no color scheme is found in local storage
    // It will proceed to read the user's system settings
     
        if (preferDarkMode.matches) {
          document.body.classList.add('dark-mode');
        } else {
          document.body.classList.remove('dark-mode');
        }
      }

    const botonDark = document.querySelector('.dark-mode-btn');

    botonDark.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');

        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('color-mode', 'true');

        }    else {
                localStorage.setItem('color-mode', 'false');
        }
    });
}