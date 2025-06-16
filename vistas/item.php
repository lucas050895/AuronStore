<?php
    include('../config/conexion.php');

    if(isset($_GET['id'])){

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META -->
    <?php include('../layout/meta.php'); ?>
    
    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/item.css">
</head>
<body>
    <main>
        <!-- MENU DE NAVEGACION -->
        <?php include("../layout/nav.php"); ?>


        <!-- CATEGORIAS -->
        <?php include("../layout/categories.php"); ?>


        <ul class="items">
            <?php
                $nuevaCon = $con->query("SELECT invItem.id AS ID,
                                                invItem.codigoBarras AS BARRAS,
                                                invItem.codigo AS CODIGO,
                                                invItem.nombre AS NOMBRE,
                                                invItem.idRubro AS RUBRO,
                                                invItem.cantidadStock AS STOCK,
                                                MAX(invPrecioItem.precio) AS COSTO,  
                                                MAX(invPrecioItem.porcentajeGanacia) AS PORCENTAJE  
                                            FROM invItem
                                            INNER JOIN invPrecioItem ON invItem.id = invPrecioItem.idItem 
                                            WHERE invItem.id = '". $_GET['id']."'
                                            GROUP BY invItem.id, invItem.nombre, invItem.codigoBarras, invItem.codigo, invItem.idRubro, invItem.cantidadStock");

                while($fila = $nuevaCon->fetch()){ ?>
                    <!-- CADA PRODUCTO -->
                    <li>
                        <img src="../assets/img/<?php 
                                                    if (empty(!$fila['CODIGO'])) {
                                                        echo $fila['RUBRO'] . '/' . $fila['CODIGO'].'.png';
                                                    }elseif(empty(!$fila['BARRAS'])){
                                                        echo $fila['RUBRO'] . '/' . $fila['BARRAS'].'.png';
                                                    }else{
                                                        echo 'image.jpg';
                                                    }
                                                ?>" alt="<?php echo $fila['NOMBRE']; ?>">
                        <div>
                            <!-- DESCRIPCION/NOMBRE -->
                            <h2><?php echo $fila['NOMBRE'] ?></h2>
                            <hr>
                            <!-- PRECIO VENTA-->
                            <h2>
                                <?php echo number_format(
                                                ($fila['COSTO'] * $fila['PORCENTAJE'] / 100 + $fila['COSTO'])
                                                , 2, ',', '.') ?>
                            </h2>
                            <!-- STOCK -->
                            <section>
                                <?php 
                                    if ($fila['STOCK'] > 0 ) {
                                        ?>
                                            <h2 class="si_hay"><?php echo 'Hay stock'; ?></h2> 
                                        <?php
                                    }else{
                                        ?>
                                            <h2 class="no_hay"><?php echo 'No hay stock'; ?></h2> 
                                        <?php
                                    }
                                ?>
                            </section>
                            <!-- CODIGO -->
                            <p>COD: <?php echo $fila['ID'] ?></p>
                        </div>
                    </li>
            <?php } ?>
        </ul>


        <!-- PIE DE PAGINA -->
        <?php include("../layout/footer.php"); ?>
    </main>
</body>
</html>

<?php }else{
    header("Location: http://lucasconde.ddns.net/AuronStore/index.php");
}?>


