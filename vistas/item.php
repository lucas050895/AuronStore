<?php
    include('../config/conexion.php');

    if(isset($_GET['id'])){

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

            <?php
                        $nuevaCon = $con->query("SELECT id, nombre,
                                                    LEFT ((((preciocosto * 1350) * 1.21) * 1.80), 9) AS precio
                                                    FROM invitem
                                                    WHERE id = '". $_GET['id']."' ");



            while($fila = $nuevaCon->fetch()){
                ?>
                    <!-- CADA PRODUCTO -->
                    <li>
                        <img src="../assets/img/image.jpg" alt="">
                        <a href="producto.php?id=<?php echo $fila[1]; ?>">
                        <div>
                            <!-- DESCRIPCION/NOMBRE -->
                            <h2><?php echo $fila[1] ?></h2>
                            <!-- PRECIO VENTA-->
                            <h2><?php echo $fila[2] ?></h2>
                            <!-- CODIGO -->
                            <p><?php echo $fila[0] ?></p>
                        </div>
                        </a>
                    </li>
                <?php
            }





            ?>

    </body>
    </html>

<?php
}
?>