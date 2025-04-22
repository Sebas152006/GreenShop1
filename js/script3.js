function agregarAlCarrito(producto_id) {
    // Encuentra el input de cantidad desde el botón presionado
    const boton = event.target;
    const contenedor = boton.closest('.botones');
    const inputCantidad = contenedor.querySelector('.unidades');
    const cantidad = parseInt(inputCantidad.value);

    fetch('php/agregar_carrito.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ producto_id, cantidad })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "ok") {
            actualizarContadorCarrito();
            alert("Producto agregado al carrito");
        } else {
            alert("Error: " + data.error);
        }
    });
}

function actualizarContadorCarrito() {
    fetch('php/obtener_total_carrito.php')
        .then(res => res.json())
        .then(data => {
            document.getElementById('contador-carrito').textContent = data.total;
        });
}

function incrementar(boton) {
    const input = boton.previousElementSibling;
    input.value = parseInt(input.value) + 1;
}

function disminuir(boton) {
    const input = boton.nextElementSibling;
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

// Llamar esta función cuando cargue la página
document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);
