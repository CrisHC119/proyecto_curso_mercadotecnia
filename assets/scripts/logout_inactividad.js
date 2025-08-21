let tiempoMaximo = 60000; // 1 minuto = 60000 ms
let temporizador;

function cerrarSesion() {
    fetch("../modelo/logout.php", { method: "POST" })
        .then(() => {
            setTimeout(() => {
                alert("Tu sesión ha expirado por inactividad.");
                window.location.href = "../../login.php?msg=Sesion_expirada";
            }, 100); // 100ms después
        });
}

function reiniciarTemporizador() {
    clearTimeout(temporizador);
    temporizador = setTimeout(cerrarSesion, tiempoMaximo);
}

["mousemove", "keydown", "click", "scroll"].forEach(evt => {
    window.addEventListener(evt, reiniciarTemporizador);
});

reiniciarTemporizador();