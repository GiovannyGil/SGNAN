-- venta, descontar insumos segun producto elegido, conectando ventas, detalleventas, productos, detalleproductos e insumos
DELIMITER //
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_ventas`
 FOR EACH ROW BEGIN 
 UPDATE detalle_productos dp
 JOIN productos p
 ON dp.productos_id = p.id
 AND dp.productos_id = NEW.id_producto
 JOIN insumos i
 ON i.id = dp.id_insumos
 SET i.Cantidad = i.Cantidad - (dp.Cantidad * NEW.Cantidad)
 WHERE p.id = NEW.id_producto;
END;

-- anular una venta
DELIMITER //
CREATE TRIGGER `tr_updStockCompraAnular` AFTER INSERT ON `compras`
 FOR EACH ROW BEGIN 
 	UPDATE insumos p 
     JOIN detalle_compras dc 
     ON dc.id_insumos = i.id
     AND dc.compra_id = new.id
     set i.Cantidad = i.Cantidad - dc.Cantidad;
end;
//
DELIMITER ;


-- compra, al realizar una compra, se agrega la cantidad de insumos comprados y guardados en detalle compra a los insumos existentes
DELIMITER //
CREATE TRIGGER `tr_updStockCompra` AFTER INSERT ON `detalle_compras`
 FOR EACH ROW BEGIN 
 UPDATE insumos i
 JOIN detalle_compras dc
 ON i.id = dc.id_insumos
 AND dc.id_insumos = NEW.id_insumos
 SET i.Cantidad = i.Cantidad + NEW.Cantidad;
END;
//
DELIMITER ;


-- Anular compra y descontar los insumos agregados en la compra
DELIMITER //
CREATE TRIGGER tr_compra_deactivated AFTER UPDATE ON compras
FOR EACH ROW
BEGIN
    IF NEW.status = 'DEACTIVATED' AND OLD.status != 'DEACTIVATED' THEN
        UPDATE insumos
        SET Cantidad = Cantidad - (
            SELECT SUM(Cantidad)*Paquetes
            FROM detalle_compras
            WHERE compra_id = NEW.id
        )
        WHERE id IN (
            SELECT id_insumos
            FROM detalle_compras
            WHERE compra_id = NEW.id
        );
    END IF;
END//
DELIMITER ;
