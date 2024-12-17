
window.addEventListener('DOMContentLoaded', event => {

    // basculer la navigation latérale
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('myApp-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('myApp-sidenav-toggled'));
        });
    }

});
