// Por ejemplo, para mostrar/ocultar representante en registro alumno
function toggleRepresentante() {
    const esMenor = document.getElementById("es_menor").checked;
    const repSection = document.getElementById("representante-section");
    repSection.style.display = esMenor ? "block" : "none";
}

document.addEventListener("DOMContentLoaded", () => {
    const esMenorCheckbox = document.getElementById("es_menor");
    if (esMenorCheckbox) {
        esMenorCheckbox.addEventListener("change", toggleRepresentante);
        toggleRepresentante(); // estado inicial
    }
});
