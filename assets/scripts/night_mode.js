// night_mode.js (eliminado)

const toggleModeBtn = document.getElementById('toggleMode');
const modeIcon = document.getElementById('modeIcon');
const body = document.body;
function setMode(isDark) {
    if (isDark) {
        body.classList.remove('light-mode');
        modeIcon.classList.remove('bi-moon');
        modeIcon.classList.add('bi-sun');
        localStorage.setItem('theme', 'dark');
    } else {
        body.classList.add('light-mode');
        modeIcon.classList.remove('bi-sun');
        modeIcon.classList.add('bi-moon');
        localStorage.setItem('theme', 'light');
    }
}
toggleModeBtn.addEventListener('click', () => {
    const isDark = !body.classList.contains('light-mode');
    setMode(!isDark);
});
window.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'dark';
    setMode(savedTheme === 'dark');
});