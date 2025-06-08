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
                                                MAX(invPrecioItem.precio) AS COSTO,  
                                                MAX(invPrecioItem.porcentajeGanacia) AS PORCENTAJE  
                                            FROM invItem
                                            INNER JOIN invPrecioItem ON invItem.id = invPrecioItem.idItem 
                                            WHERE invItem.id = '". $_GET['id']."'
                                            GROUP BY invItem.id, invItem.nombre, invItem.codigoBarras, invItem.codigo");

                while($fila = $nuevaCon->fetch()){ ?>
                    <!-- CADA PRODUCTO -->
                    <li>
                        <img src="../assets/img/<?php 
                                                    if (empty(!$fila['CODIGO'])) {
                                                        echo $fila['CODIGO'].'.png';
                                                    }elseif(empty(!$fila['BARRAS'])){
                                                        echo $fila['BARRAS'].'.png';
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

<?php } ?>


