const fallbackTimeout = 300000; // 5 minutos por defecto para logout
const HEARTBEAT_INTERVAL = 60000; // 1 minuto (60 segundos) para el Heartbeat
const tiempoMaximoInactividad = window.INACTIVITY_TIMEOUT || fallbackTimeout;

let temporizadorLogout;
let heartbeatIntervalId; 
let ultimoHeartbeat = 0;
let unidadActual = -1; 

// ----------------------------------------------------
// HEARTBEAT LOGIC
// ----------------------------------------------------

/**
 * Envia la señal de Heartbeat para actualizar la columna de tiempo en la BD.
 * @param {boolean} force - Si es true, se ignora el tiempo transcurrido (usado para la inicialización).
 */
function sendHeartbeat(force = false) {
    const ahora = Date.now();
    
    // Si NO forzamos, comprobamos si ha pasado el intervalo.
    if (!force && (ahora - ultimoHeartbeat < HEARTBEAT_INTERVAL)) {
        return;
    }

    // Comprobación de seguridad
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
            return response.json(); // Intentamos leer el JSON de error del servidor
        }
        return response.json();
    })
    .then(data => {
        // Marcamos el tiempo después de recibir la respuesta (exitosa o fallida)
        ultimoHeartbeat = ahora;

        if (data.success) {
            // MUESTRA EL MENSAJE DE CONTABILIZACIÓN EN LA CONSOLA
            console.log(`[Heartbeat ÉXITO] Minuto contabilizado para la unidad ${unidadActual}. Mensaje: ${data.message}`);
        } else {
            console.error(`[Heartbeat FALLO] Error de lógica en servidor. Mensaje: ${data.message}`);
        }
    })
    .catch(error => {
        console.error(`[Heartbeat CRÍTICO] Fallo en la conexión (Network Error): ${error}`);
    });
}

// ----------------------------------------------------
// HEARTBEAT ACTIVATION & INACTIVITY LOGIC 
// ----------------------------------------------------

function stopHeartbeat() {
    if (heartbeatIntervalId) {
        clearInterval(heartbeatIntervalId);
        console.log("Heartbeat detenido por inactividad.");
    }
}

function cerrarSesionPorInactividad() {
    console.log("Inactividad detectada, deteniendo Heartbeat e intentando cerrar sesión...");
    
    // 1. DETENER EL CONTADOR DEL HEARTBEAT INMEDIATAMENTE
    stopHeartbeat(); 
    
    // 2. Procede con el logout 
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
    // 1. Limpia el temporizador de inactividad
    clearTimeout(temporizadorLogout);
    
    // 2. Ejecuta el Heartbeat si ha pasado un minuto
    sendHeartbeat(); 
    
    // 3. Reinicia el temporizador de inactividad
    temporizadorLogout = setTimeout(cerrarSesionPorInactividad, tiempoMaximoInactividad);
}

document.addEventListener("DOMContentLoaded", () => {
    // 1. INICIA EL TEMPORIZADOR DEL HEARTBEAT EN LA CARGA
    if (unidadActual !== -1) {
        // Enviamos el Heartbeat inmediatamente al cargar, FORZANDO la primera ejecución.
        // Esto asegura que el primer minuto se registre.
        sendHeartbeat(true); 
        
        // Configuramos el Heartbeat periódico para las siguientes repeticiones
        heartbeatIntervalId = setInterval(sendHeartbeat, HEARTBEAT_INTERVAL);
        console.log(`Heartbeat periódico iniciado (ID: ${heartbeatIntervalId}) para la unidad ${unidadActual}.`);
    }

    // 2. Configuración de Detección de actividad
    const eventosActividad = ["mousemove", "keydown", "click", "scroll", "touchstart"];
    eventosActividad.forEach(evt => {
        window.addEventListener(evt, reiniciarTemporizador, { passive: true });
    });

    // Inicia el temporizador de inactividad
    reiniciarTemporizador();
});