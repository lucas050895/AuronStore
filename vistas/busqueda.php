<?php
    include('../config/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include("../layout/head.php");
    ?>
    
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


        <?php
            if(isset($_GET['buscar'])){
                $busqueda = $_GET['busqueda'];

                $consu = $con->query("SELECT * FROM invItem WHERE nombre LIKE '%$busqueda%'");
            }




            while($fila = $consu->fetch()){
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

        

    </main>
</body>
</html>