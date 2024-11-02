<?php
    include('../config/conexion.php');

    if(isset($_GET['id'])){

        $resultado = $pdo -> query ('SELECT * FROM invitem WHERE idRubro = "'.$_GET['id'].'"')or die($pdo -> error);
        if(mysqli_num_rows($resultado) > 0){ 
            $fila = mysqli_fetch_row($resultado);
        }
    }
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
            <form action="">
                <label for="busqueda">
                    <i class="fas fa-search"></i>
                </label>
                <input id="busqueda" name="busqueda" type="text" placeholder="Busqueda de articulos" required>
                <input type="submit" value="Buscar" name="buscar">
            </form>
        </div>

        <!-- CONTENEDOR LOS PRODUCTOS -->
        <?php
            $consulta = mysqli_query($pdo,"SELECT id, LEFT (nombre,25) AS nombre, LEFT ((((preciocosto * 1350) * 1.21) * 1.80), 9)AS precio
                                                        FROM invitem
                                                        WHERE idRubro = '". $_GET['id']."' ");

        ?>

        <div id="productos">
            <ul>
                <?php
                    while($fila=mysqli_fetch_assoc($consulta)){
                        ?>
                            <!-- CADA PRODUCTO -->
                            <li>
                                <img src="../assets/img/image.jpg" alt="">
                                <a href="producto.php?id=<?php echo $fila['id']; ?>">
                                    <div>
                                        <p><?php echo $fila['nombre'];?></p>
                                        <p><?php echo $fila['precio'];?></p>
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