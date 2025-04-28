// Obtiene los formularios y botones
const formularios = document.querySelectorAll(".formulario");
const btnSiguiente = document.getElementById("btn-siguiente");
const btnAnterior = document.getElementById("btn-anterior");

let formularioActual = 0;

// Actualiza la visibilidad de los formularios
function actualizarFormulario() {
    formularios.forEach((formulario, index) => {
        formulario.classList.toggle("activo", index === formularioActual);
    });

    // Mostrar/ocultar botones
    btnAnterior.style.display = formularioActual === 0 ? "none" : "inline-block";
    btnSiguiente.textContent = formularioActual === formularios.length - 1 ? "RECUPERAR CONTRASEÑA" : "SIGUIENTE";
}

// Evento para botón "Siguiente"
btnSiguiente.addEventListener("click", () => {
    if (formularioActual < formularios.length - 1) {
        formularioActual++;
        actualizarFormulario();
    } else {
        window.location.href = "index.php"
    }
});

// Evento para botón "Anterior"
btnAnterior.addEventListener("click", () => {
    if (formularioActual > 0) {
        formularioActual--;
        actualizarFormulario();
    }
});

// Inicializar el primer formulario
actualizarFormulario();
