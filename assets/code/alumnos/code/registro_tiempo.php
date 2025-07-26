<script>
let minutosAcumulados = 0;
let tiempoInicio = Date.now();
let minutosEnviadosTotal = 0;

// Aumenta cada minuto (60,000 milisegundos)
const contador = setInterval(() => {
  minutosAcumulados++;
}, 60000);

// Envía cada minuto
const envio = setInterval(() => {
  if (minutosAcumulados > 0) {
    fetch('/assets/code/modelo/registrar_tiempo.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `minutos=${minutosAcumulados}`
    });
    minutosEnviadosTotal += minutosAcumulados;
    minutosAcumulados = 0;
  }
}, 60000);

// Envía solo los minutos que **no fueron enviados aún**
window.addEventListener('beforeunload', () => {
  const totalMinutos = Math.floor((Date.now() - tiempoInicio) / 60000);
  const minutosFaltantes = totalMinutos - minutosEnviadosTotal;

  if (minutosFaltantes > 0) {
    navigator.sendBeacon('/assets/code/modelo/registrar_tiempo.php',
      new URLSearchParams({ minutos: minutosFaltantes }));
  }
});

</script>
