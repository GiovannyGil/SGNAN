
            $(document).ready(function(){
                $('#agregar').click(function(){
                    agregar();
                });
            });
        
            var total = 0;
            var productosSeleccionados = {};
            $("#totalcompleto").hide();
            $("#boton-generar-venta").hide();
            $("#id_producto").change(mostrarValores);

            $("#id_insumos").change(mostrarValores2);

            function mostrarValoresInsu(){
                datosProductos2 = document.getElementById("id_insumos").value.split('_');
                $("#cantidaduu").val(datosProductos2[0]);
            }
        
            function mostrarValores(){
                datosProducto = document.getElementById('id_producto').value.split('_');
                $("#Precio").val(datosProducto[2]);
                $("#Precio").val(precio.toLocaleString("es-CO", { style: "currency", currency: "COP" }));

            }



            function agregar(){
                datosProducto = document.getElementById('id_producto').value.split('_');
                id_producto = datosProducto[0];
                producto = $("#id_producto option:selected").text();
                cantidad = $("#Cantidad").val();
                // precio = $("#Precio").val();
                const precio = parseFloat($("#Precio").val().replace(/[^0-9.-]+/g,""));
                empleado = $("#id_empleado").val();

                // Obtener la cantidad disponible del producto
                //cantidadDisponible = $("#id_producto option:selected").data('cantidad');

        
                if (id_producto != "" && parseInt(cantidad) != "" && parseInt(cantidad) > 0 && parseFloat(precio) != "" && empleado != ""){
                    subtotal = (parseInt(cantidad) * parseFloat(precio));
        
                    // Verificar si el producto ya ha sido seleccionado
                    if (productosSeleccionados.hasOwnProperty(id_producto)) {
                        // Actualizar la cantidad y subtotal del producto existente
                        productosSeleccionados[id_producto].cantidad += parseInt(cantidad);
                        productosSeleccionados[id_producto].subtotal += subtotal;
                        var filaExistente = productosSeleccionados[id_producto].fila;
                        filaExistente.find('.cantidad').val(productosSeleccionados[id_producto].cantidad);
                        filaExistente.find('.subtotal').val(productosSeleccionados[id_producto].subtotal);
                    } else {
                        // Agregar el nuevo producto al objeto de productos seleccionados
                        // var fila = '<tr class="selected"><td><button type="button" class="btn btn-warning" onclick="eliminar(this);">X</button></td><td><input type="hidden" name="id_producto[]" value="' + id_producto + '">' + producto + '</td><td><input type="number" class="precio form-control" name="Precio[]" value="' + precio + '" readonly></td><td><input type="number" class="cantidad form-control" name="Cantidad[]" value="' + cantidad + '" readonly></td><td><input type="number" class="subtotal form-control" value="' + subtotal + '" readonly></td></tr>';
                        var fila = '<tr class="selected"><td><button type="button" class="btn btn-warning" onclick="eliminar(this);">X</button></td><td><input type="hidden" name="id_producto[]" value="' + id_producto + '">' + producto + '</td><td><input type="text" class="precio form-control" name="Precio[]" value="' + precio.toLocaleString("es-CO", { style: "currency", currency: "COP" }) + '" readonly></td><td><input type="text" class="cantidad form-control" name="Cantidad[]" value="' + cantidad + '" readonly></td><td><input type="number" class="subtotal form-control" value="' + subtotal + '" readonly></td></tr>';

                        var nuevaFila = $(fila);
                        productosSeleccionados[id_producto] = {
                            fila: nuevaFila,
                            cantidad: parseInt(cantidad),
                            subtotal: subtotal
                        };
                        $('#detalles').append(nuevaFila);
                    }
        
                    total += subtotal;
                    totales();
                    evaluar();
                    Limpiar();
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Error al ingresar el detalle de la venta, revise los datos del producto',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }
        
            function totales(){
                // $("#total").html(total.toFixed(2));
                total_pagar = total;
                // $("#total_pagar_html").html(total_pagar.toFixed(2));
                // $("#total_pagar").val(total_pagar.toFixed(2));
                
                const formatoTotal = total.toLocaleString("es-CO", { style: "currency", currency: "COP" });
                const formatoTotalPagar = total_pagar.toLocaleString("es-CO", { style: "currency", currency: "COP" });

                // Actualización de los elementos HTML con los valores formateados
                $("#total").html(formatoTotal);
                $("#total_pagar_html").html(formatoTotalPagar);
                $("#total_pagar").val(formatoTotalPagar);
                
            }
            function Limpiar(){
                $("#Cantidad").val("");
                $("#Precio").val("");
                $("#id_producto").val("");

            }
        
            function evaluar(){
                if (total > 0){
                    $("#boton-generar-venta").show();
                } else {
                    $("#boton-generar-venta").hide();
                }
            }
        
            function eliminar(btn){
                var fila = $(btn).closest('tr');
                var id_producto = fila.find("input[name='id_producto[]']").val();
                var subtotal = parseFloat(fila.find('.subtotal').val());

                fila.remove();

                total -= subtotal;
                delete productosSeleccionados[id_producto];

                totales();
                evaluar();
            }
    