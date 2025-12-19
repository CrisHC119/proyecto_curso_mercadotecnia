// logout_inactividad.js

const fallbackTimeout = 300000;
const HEARTBEAT_INTERVAL = 60000;
const tiempoMaximoInactividad = window.INACTIVITY_TIMEOUT || fallbackTimeout;

let temporizadorLogout;
let heartbeatIntervalId; 
let ultimoHeartbeat = 0;
let unidadActual = -1; 

function sendHeartbeat(force = false) {
    const ahora = Date.now();
    if (!force && (ahora - ultimoHeartbeat < HEARTBEAT_INTERVAL)) {
        return;
    }
    if (unidadActual === -1) {
        console.warn("Heartbeat NO enviado: unidadActual no inicializada.");
        return;
    }
    const data = new FormData();
    data.append('unidad', unidadActual);
    fetch('/assets/modelo/login_alumno/actualizar_minutos/heartbeat.php', {
        method: 'POST',
        body: data,
        keepalive: true 
    })
    .then(response => {
        if (!response.ok) {
            console.error(`Heartbeat ERROR HTTP. Status: ${response.status}`);
            return response.json();
        }
        return response.json();
    })
    .then(data => {
        ultimoHeartbeat = ahora;
        if (data.success) {
            console.log(`[Heartbeat ÉXITO] Minuto contabilizado para la unidad ${unidadActual}. Mensaje: ${data.message}`);
        } else {
            console.error(`[Heartbeat FALLO] Error de lógica en servidor. Mensaje: ${data.message}`);
        }
    })
    .catch(error => {
        console.error(`[Heartbeat CRÍTICO] Fallo en la conexión (Network Error): ${error}`);
    });
}
function stopHeartbeat() {
    if (heartbeatIntervalId) {
        clearInterval(heartbeatIntervalId);
        console.log("Heartbeat detenido por inactividad.");
    }
}
function cerrarSesionPorInactividad() {
    console.log("Inactividad detectada, deteniendo Heartbeat e intentando cerrar sesión...");
    stopHeartbeat(); 
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
    sendHeartbeat(); 
    temporizadorLogout = setTimeout(cerrarSesionPorInactividad, tiempoMaximoInactividad);
}
document.addEventListener("DOMContentLoaded", () => {
    if (unidadActual !== -1) {
        sendHeartbeat(true); 
        heartbeatIntervalId = setInterval(sendHeartbeat, HEARTBEAT_INTERVAL);
        console.log(`Heartbeat periódico iniciado (ID: ${heartbeatIntervalId}) para la unidad ${unidadActual}.`);
    }
    const eventosActividad = ["mousemove", "keydown", "click", "scroll", "touchstart"];
    eventosActividad.forEach(evt => {
        window.addEventListener(evt, reiniciarTemporizador, { passive: true });
    });
    reiniciarTemporizador();
});