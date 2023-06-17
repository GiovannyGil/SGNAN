function verificarInsumosSuficientes() {
    fetch('/verificar-insumos-suficientes')
        .then(response => response.json())
        .then(data => {
            const botonGenerarVenta = document.getElementById('boton-generar-venta');
            if (data.insumosSuficientes) {
                botonGenerarVenta.disabled = false;
            } else {
                botonGenerarVenta.disabled = true;
            }
        });
}

verificarInsumosSuficientes(); // Verificar al cargar la página
setInterval(verificarInsumosSuficientes, 5000); // Verificar cada 5 segundos
