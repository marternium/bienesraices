document.addEventListener('DOMContentLoaded', () => {
    eventListeners();
    darkMode();
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