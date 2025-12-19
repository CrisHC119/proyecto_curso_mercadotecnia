// ocultar_extension.js (eliminado)

window.addEventListener("DOMContentLoaded", () => {
  let url = window.location.href;
  if (url.includes(".php")) {
    let nuevaUrl = url.replace(".php", "");
    window.history.replaceState({}, document.title, nuevaUrl);
  }
});