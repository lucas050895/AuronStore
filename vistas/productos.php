<?php
    include('../config/conexion.php');

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

            <!-- CONSULTA DE P -->
            <div id="search">
                <form action="busqueda.php" method="GET">
                    <label for="busqueda">
                        <i class="fas fa-search"></i>
                    </label>
                    <input id="busqueda" name="busqueda" type="text" placeholder="Busqueda de articulos" required>
                    <input type="submit" value="Buscar" name="buscar">
                </form>
            </div>

            <!-- CONSULTA LOS PRODUCTOS -->
            <?php
                // Obtener el número total de registros
                $stmt = $con->prepare("SELECT COUNT(DISTINCT invItem.id) FROM invItem 
                                    INNER JOIN invPrecioItem ON invItem.id = invPrecioItem.idItem");
                $stmt->execute();
                $total_registros = $stmt->fetchColumn();

                // Definir la cantidad de registros por página
                $por_pagina = 30;

                // Obtener la página actual desde la URL
                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

                // Calcular el número total de páginas
                $total_paginas = ceil($total_registros / $por_pagina);

                // Asegurar que la página actual esté dentro de los límites
                if ($pagina < 1) {
                    $pagina = 1;
                } elseif ($pagina > $total_paginas) {
                    $pagina = $total_paginas;
                }

                // Calcular el OFFSET
                $desde = ($pagina - 1) * $por_pagina;

                // Ejecutar la consulta con paginación
                $stmt = $con->prepare("SELECT invItem.id AS ID,  
                                            LEFT(invItem.nombre, 25) AS NOMBRE,  
                                            MAX(invPrecioItem.precio) AS COSTO,  
                                            MAX(invPrecioItem.porcentajeGanacia) AS PORCENTAJE  
                                    FROM invItem  
                                    INNER JOIN invPrecioItem ON invItem.id = invPrecioItem.idItem  
                                    GROUP BY invItem.id, invItem.nombre  
                                    ORDER BY invItem.id  
                                    OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY;");
                $stmt->bindParam(':offset', $desde, PDO::PARAM_INT);
                $stmt->bindParam(':limit', $por_pagina, PDO::PARAM_INT);
                $stmt->execute();
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            ?>

            <div id="productos">
                <ul>
                    <!-- Mostrar los resultados -->
                    <?php foreach ($resultados as $fila) {
                        ?>
                            <!-- CADA PRODUCTO -->
                            <li>
                                <img src="../assets/img/image.jpg" alt="">
                                <a href="producto.php?id=<?php echo $fila['ID']; ?>">
                                    <div>
                                        <p><?php echo $fila['NOMBRE'];?></p>
                                        <p><?php echo $fila['COSTO'];?></p>
                                    </div>
                                </a>
                            </li>
                        <?php
                    }?>
                </ul>

            </div>

            <!-- Generar paginación -->
            <div class="paginador">
                <ul>
                    <?php
                        if($pagina !=1){
                    ?>
                        <li><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-angle-double-left"></i></a></li>
                        <li><a href="?pagina=<?php echo $pagina-1 ?>"><i class="fas fa-chevron-left"></i></a></li>
                    <?php
                        }
                    ?>

                    <li class="num">
                        <p><?php echo $pagina; ?> </p> 

                        <p>/</p>

                        <p> <?php echo $total_paginas; ?> </p>
                    </li>

                    <?php

                        if($pagina != $total_paginas){    
                    ?>
                        <li><a href="?pagina=<?php echo $pagina+1 ?>"><i class="fas fa-chevron-right"></i></a></li>
                        <li><a href="?pagina=<?php echo $total_paginas;?>"><i class="fas fa-angle-double-right"></i></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>

            <?php
                include("../layout/footer.php")
            ?>
        </main>
    </body>
    </html>
