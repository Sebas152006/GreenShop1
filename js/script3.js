// Se encarga de aumentar las unidades a desear
function incrementar(button) { 
    var input = button.parentElement.querySelector('.unidades'); 
    input.value = parseInt(input.value) + 1; 
}

// Se encarga de disminuir las unidades deseadas
function disminuir(button) { 
    var input = button.parentElement.querySelector('.unidades'); 
    input.value = Math.max(1, parseInt(input.value) - 1); // Evitar que el valor baje de 1
}

document.addEventListener('DOMContentLoaded', () => {
    const contCarrito = document.getElementById('contador-carrito');
    let totalItems = 0; // Contador total de productos

    // Añadir evento a todos los botones de "AGREGAR AL CARRITO"
    document.querySelectorAll('.agregar').forEach((button) => {
        button.addEventListener('click', function () {
            // Obtener el valor del input de cantidad (unidades) correspondiente
            const input = this.parentNode.querySelector('.unidades');
            const quantity = parseInt(input.value);

            // Incrementar el total de productos en el carrito
            totalItems += quantity;
            contCarrito.textContent = totalItems; // Actualizar el número en el carrito
        });
    });
});

// Función para disminuir el valor del input
function disminuir(button) {
    const input = button.nextElementSibling;
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

// Función para aumentar el valor del input
function incrementar(button) {
    const input = button.previousElementSibling;
    input.value = parseInt(input.value) + 1;
}