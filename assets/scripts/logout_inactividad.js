const tiempoMaximoInactividad = 300000;

let temporizadorLogout;

function cerrarSesionPorInactividad() {
    console.log("Inactividad detectada, intentando cerrar sesión...");
    
    fetch("/assets/modelo/logout.php", { method: "POST" })
        .then(response => {
             console.log("Solicitud de logout enviada.");
             setTimeout(() => {
                alert("Tu sesión ha expirado por inactividad.");
                window.location.href = "/login.php?msg=Sesion_expirada";
            }, 100);
        })
        .catch(error => {
            console.error("Error al intentar cerrar sesión:", error);
             setTimeout(() => {
                alert("Hubo un problema al cerrar tu sesión por inactividad. Serás redirigido.");
                window.location.href = "/login.php?msg=Error_logout";
            }, 100);
        });
}

function reiniciarTemporizador() {
    clearTimeout(temporizadorLogout);
    temporizadorLogout = setTimeout(cerrarSesionPorInactividad, tiempoMaximoInactividad);
}

document.addEventListener("DOMContentLoaded", () => {
    console.log("Iniciando script de inactividad.");
    
    const eventosActividad = ["mousemove", "keydown", "click", "scroll", "touchstart"];
    eventosActividad.forEach(evt => {
        window.addEventListener(evt, reiniciarTemporizador, { passive: true });
    });

    reiniciarTemporizador();
});