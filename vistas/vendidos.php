<?php include('../config/conexion.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META -->
    <?php include('../layout/meta.php'); ?>

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main>
        <!-- MENU DE NAVEGACION -->
        <?php include("../layout/nav.php"); ?>


        <!-- CATEGORIAS -->
        <?php include("../layout/categories.php"); ?>


        <!-- MAS VENDIDOS -->
        <?php
            $MasVendidos = $con->query("SELECT TOP 20
                                            invItem.id,
                                            LEFT(invItem.nombre, 15) AS NOMBRE,
                                            invItem.cantidadStock,
                                            MAX(invPrecioItem.precio) AS COSTO,  
                                            MAX(invPrecioItem.porcentajeGanacia) AS PORCENTAJE
                                        FROM admItemComprobante
                                        INNER JOIN invItem ON invItem.id = admItemComprobante.idItem
                                        RIGHT JOIN invPrecioItem ON invItem.id = invPrecioItem.idItem
                                        WHERE admItemComprobante.fechaCreacion < GETDATE() AND invItem.cantidadStock > 0
                                        GROUP BY invItem.id, invItem.nombre, invItem.cantidadStock;");
        ?>


        <div class="container_products">
            <?php
                while($fila = $MasVendidos->fetch()){ ?>
                <div class="products">
                    <a href="http://lucasconde.ddns.net/AuronStore/vistas/item.php?id=<?php echo $fila['ID']; ?>">
                        <img src="../assets/img/image.jpg" alt="<?php echo $fila['NOMBRE']; ?>">
                        <div>
                            <p>
                                <?php echo $fila['NOMBRE']; ?>
                            </p>
                            <hr>
                            <p>
                                <?php echo number_format(
                                    ($fila['COSTO'] * $fila['PORCENTAJE'] / 100 + $fila['COSTO'])
                                    , 2, ',', '.') ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
        

        <!-- PIE DE PAGINA -->
        <?php include("../layout/footer.php"); ?>
    </main>
    
</body>
</html>


