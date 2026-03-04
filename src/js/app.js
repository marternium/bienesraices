document.addEventListener('DOMContentLoaded', () => {
    eventListeners();
    darkMode();
    setDarkMode();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    if(mobileMenu) {
        mobileMenu.addEventListener('click', navegacionResponsive);
    }
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function darkMode() {
    const darkModeBoton = document.querySelector('.dark-mode-boton');
    darkModeBoton.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
}

function setDarkMode() {
    const darkMode = window.matchMedia('(prefers-color-scheme: dark)');
    if(darkMode.matches) {
        document.body.classList.add('dark-mode');
    }
}