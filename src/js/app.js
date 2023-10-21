document.addEventListener('DOMContentLoaded', function(){

    eventListeners();
    darkMode();
    // mostrarNotificacionPorTiempo(10);
})

function eventListeners(){
    
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    const notificacionCrud = document.querySelector('body');
    notificacionCrud.addEventListener('DOMContentLoaded', mostrarNotificacionPorTiempo(8) );
}

function darkMode(){

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)')
    console.log(prefiereDarkMode)

    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode')
    }else{
        document.body.classList.remove('dark-mode')
    }

    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode')
        }else{
            document.body.classList.remove('dark-mode')
        }
    })

    const botonDarkMode = document.querySelector(".dark-mode-boton");

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode')
          //Para que el modo elegido se quede guardado en local-storage
          if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('modo-oscuro','true');
        } else {
            localStorage.setItem('modo-oscuro','false');
        }
    })

    //Obtenemos el modo del color actual
    if (localStorage.getItem('modo-oscuro') === 'true') {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
}

function navegacionResponsive(){

    const navNavegacion = document.querySelector('.navegacion');
    navNavegacion.classList.toggle("mostrar");

    // if(navNavegacion.classList.contains('mostrar'))
    //     navNavegacion.classList.remove("mostrar");
    // else
    //     navNavegacion.classList.add("mostrar");
}


function mostrarNotificacionPorTiempo(tiempo) {
    const mensaje = document.querySelector('#notificacionCrud');
    if(mensaje !== null){
        setTimeout(function() {
            mensaje.classList.add("invisible");
    
        }, tiempo * 1000); // Convierte el tiempo a milisegundos
    }
}