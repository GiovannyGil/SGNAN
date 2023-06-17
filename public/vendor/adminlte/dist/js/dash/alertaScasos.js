function verificarInsumosAgotados() {
    fetch('/verificar-insumos-agotados')
        .then(response => response.json())
        .then(data => {
            if (data.hayInsumosAgotados) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: '¡Alerta de insumos agotados!',
                    text: 'Hay ' + data.cantidadInsumosAgotados + ' insumos agotados. Por favor, revisa el stock.',
                    showConfirmButton: false,
                    timer: 3600000 // 1 hora
                });

                document.getElementById('boton-generar-venta').disabled = true;
            } else {
                document.getElementById('boton-generar-venta').disabled = false;
            }
        });
}

setInterval(verificarInsumosAgotados, 5000); // Ejecutar cada 5 segundos
