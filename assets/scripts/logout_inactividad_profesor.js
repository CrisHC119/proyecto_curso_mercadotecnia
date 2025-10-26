const tiempoMaximo = 60000;
let temporizador;

function cerrarSesionPorInactividad() {
    fetch("../modelo/logout_profesor.php", { method: "POST" })
        .then(() => {
            setTimeout(() => {
                alert("Tu sesión ha expirado por inactividad.");
                window.location.href = "../../login.php?msg=Sesion_expirada";
            }, 100);
        });
}

function reiniciarTemporizador() {
    clearTimeout(temporizador);
    temporizador = setTimeout(cerrarSesionPorInactividad, tiempoMaximo);
}

document.addEventListener("DOMContentLoaded", () => {
    
    ["mousemove", "keydown", "click", "scroll", "touchstart"].forEach(evt => {
        window.addEventListener(evt, reiniciarTemporizador);
    });

    reiniciarTemporizador();
});