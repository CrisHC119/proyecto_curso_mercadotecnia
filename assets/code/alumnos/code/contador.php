<style>
  :root {
    --circle-offset-y: 0px; /* 🔁 Mueve verticalmente el círculo */
  }

  /* Contenedor principal del aviso */
  #sessionWarning {
    position: fixed;
    bottom: 40px;
    right: 20px;
    width: 120px;
    height: 140px;
    background: rgba(0,0,0,0.8);
    border-radius: 16px;
    color: white;
    font-family: monospace, monospace;
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    user-select: none;
    box-shadow: 0 0 15px rgba(255,0,0,0.7);
    padding: 10px 0;
    box-sizing: border-box;
  }

  /* Contenedor del círculo */
  #sessionWarning .circle-container {
    position: relative;
    width: 100px;
    height: 100px;
    transform: translateY(var(--circle-offset-y));
  }

  /* SVG de borde y progreso */
  #sessionWarning svg {
    transform: rotate(-90deg);
    width: 100px;
    height: 100px;
    display: block;
    position: relative;
    z-index: 1;
  }

  #sessionWarning svg circle {
    fill: none;
    stroke-width: 8;
    stroke-linecap: round;
  }

  .bg {
    stroke: #444; /* ⚫ Borde estático */
  }

  .progress {
    stroke: #ff4444; /* 🔴 Progreso animado */
    transition: stroke-dashoffset 1s linear;
  }

  /* ⚫ Fondo negro redondo detrás del número */
  .circle-background {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 96px;
    height: 96px;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 50%;
    z-index: 2;
  }

  /* ⏱️ Número al centro */
  .time {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1.8rem;
    font-weight: bold;
    pointer-events: none;
    user-select: none;
    z-index: 3;
  }

  /* 🛑 Mensaje de advertencia */
  .message {
    font-size: 0.85rem;
    text-align: center;
    margin-top: 8px;
    pointer-events: none;
    padding: 4px 8px;
    width: 100%;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 6px;
  }
</style>

<div id="sessionWarning" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="circle-container">
    <!-- SVG borde gris y progreso -->
    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
      <circle class="bg" cx="50" cy="50" r="45"></circle>
      <circle class="progress" cx="50" cy="50" r="45" stroke-dasharray="282.6" stroke-dashoffset="0"></circle>
    </svg>
    <!-- Fondo negro detrás del número -->
    <div class="circle-background"></div>
    <!-- Tiempo visible -->
    <div class="time" aria-label="Tiempo restante">05:00</div>
  </div>
  <div class="message">Tu sesión se cerrará si no hay actividad.</div>
</div>
<script>
(function(){
  const logoutURL = '/assets/code/modelo/logout.php';
  const sessionWarning = document.getElementById('sessionWarning');
  const progressCircle = sessionWarning.querySelector('.progress');
  const timeDisplay = sessionWarning.querySelector('.time');

  const FULL_DASH_ARRAY = 2 * Math.PI * 45;
  let totalTime = 120;
  let warningTime = 30;
  let timeLeft = totalTime;
  let countdownInterval;

  function formatTime(s) {
    const m = Math.floor(s / 60).toString().padStart(2, '0');
    const sec = (s % 60).toString().padStart(2, '0');
    return `${m}:${sec}`;
  }

  function setCircleDashoffset() {
    const fraction = timeLeft / warningTime;
    const offset = FULL_DASH_ARRAY * (1 - fraction);
    progressCircle.style.strokeDashoffset = offset;
  }

  function showWarning() {
    sessionWarning.style.display = 'flex';
  }

  function hideWarning() {
    sessionWarning.style.display = 'none';
    progressCircle.style.strokeDashoffset = 0;
  }

  function startCountdown() {
    clearInterval(countdownInterval);
    countdownInterval = setInterval(() => {
      timeLeft--;

      if(timeLeft <= warningTime){
        showWarning();
        timeDisplay.textContent = formatTime(timeLeft);
        setCircleDashoffset();

        if(timeLeft <= 0){
          clearInterval(countdownInterval);
          window.location.href = logoutURL;
        }
      }
    }, 1000);
  }

  function resetTimer() {
    timeLeft = totalTime;
    hideWarning();
  }

  function activityDetected() {
    resetTimer();
  }

  ['mousemove','keydown','scroll','touchstart'].forEach(ev => {
    window.addEventListener(ev, activityDetected);
  });

  resetTimer();
  startCountdown();
})();
</script>
