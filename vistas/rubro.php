<?php
    include('../config/conexion.php');

    if(isset($_GET['id'])){

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Auron Store</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/productos.css">
        <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <main>
            <?php
                include("../layout/nav.php")
            ?>

            <div id="search">
                <form action="busqueda.php" method="GET">
                    <label for="busqueda">
                        <i class="fas fa-search"></i>
                    </label>
                    <input id="busqueda" name="busqueda" type="text" placeholder="Busqueda de articulos" required>
                    <input type="submit" value="Buscar" name="buscar">
                </form>
            </div>

            <!-- CONTENEDOR LOS PRODUCTOS -->

        
            <?php
                $nuevaCon = $con->query("SELECT id,
                                            LEFT (nombre,25) AS nombre,
                                            LEFT ((((preciocosto * 1350) * 1.21) * 1.80), 9) AS precio
                                            FROM invitem
                                            WHERE idRubro = '". $_GET['id']."' ");


            ?>

            <div id="productos">
                <ul>
                    <?php

                        while($fila = $nuevaCon->fetch()){
                            ?>
                                <!-- CADA PRODUCTO -->
                                <li>
                                    <img src="../assets/img/image.jpg" alt="">
                                    <a href="producto.php?id=<?php echo $fila[1]; ?>">
                                        <div>
                                            <p><?php echo $fila[1];?></p>
                                            <p><?php echo $fila[2];?></p>
                                        </div>
                                    </a>
                                </li>
                            <?php
                        }
                    ?>
                </ul>
            </div>

        </main>
    </body>
    </html>

<?php
}
?>