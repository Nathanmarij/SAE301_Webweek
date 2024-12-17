
window.addEventListener('DOMContentLoaded', event => {

    //document.body.classList.add('myApp-sidenav-toggled');
    
    // basculer la navigation latérale
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('myApp-sidenav-toggled');
        });
    }

});
