<?php  include('../config/conexion.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META -->
    <?php include('../layout/meta.php'); ?>

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <main>
        <!-- MENU DE NAVEGACION -->
        <?php include("../layout/nav.php"); ?>


        <!-- CATEGORIAS -->
        <?php include("../layout/categories.php"); ?>


        <!-- CONSULTA LOS PRODUCTOS -->
        <?php
            // Obtener el número total de registros
            $stmt = $con->prepare("SELECT COUNT(DISTINCT invItem.id)
                                        FROM invItem 
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
                                            invItem.codigoBarras AS BARRAS,
                                            invItem.codigo AS CODIGO,
                                            invItem.cantidadStock AS STOCK,
                                            invItem.idRubro AS RUBRO,
                                            LEFT(invItem.nombre, 15) AS NOMBRE,  
                                            MAX(invPrecioItem.precio) AS COSTO,  
                                            MAX(invPrecioItem.porcentajeGanacia) AS PORCENTAJE
                                    FROM invItem  
                                    INNER JOIN invPrecioItem ON invItem.id = invPrecioItem.idItem
                                    GROUP BY invItem.id, invItem.nombre, invItem.codigoBarras, invItem.codigo, invItem.cantidadStock, invItem.idRubro
                                    ORDER BY invItem.nombre  
                                    OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY;");
            $stmt->bindParam(':offset', $desde, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $por_pagina, PDO::PARAM_INT);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        ?>
        <div class="container_products">
            <?php
                if($resultados){
                    foreach($resultados as $fila){ ?>
                        <div class="products">
                            <a href="item?id=<?php echo $fila['ID']; ?>">
                                <img src="../assets/img/<?php 
                                                        if (empty(!$fila['CODIGO'])) {
                                                            echo $fila['RUBRO'] . '/' . $fila['CODIGO'] . '.png';
                                                        }elseif(empty(!$fila['BARRAS'])){
                                                            echo $fila['RUBRO'] . '/' . $fila['BARRAS'].'.png';
                                                        }else{
                                                            echo 'image.jpg';
                                                        }
                                                        ?>" alt="<?php echo $fila['NOMBRE']; ?>">
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
            <?php }
                }
            ?>
        </div>


        <!-- Generar paginación -->
        <div class="paginador">
            <ul>
                <?php
                    if($pagina !=1){
                ?>
                    <li><a href="http://lucasconde.ddns.net/AuronStore/vistas/productos?pagina=<?php echo 1; ?>"><i class="fas fa-angle-double-left"></i></a></li>
                    <li><a href="http://lucasconde.ddns.net/AuronStore/vistas/productos?pagina=<?php echo $pagina-1 ?>"><i class="fas fa-chevron-left"></i></a></li>
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
                    <li><a href="http://lucasconde.ddns.net/AuronStore/vistas/productos?pagina=<?php echo $pagina+1 ?>"><i class="fas fa-chevron-right"></i></a></li>
                    <li><a href="http://lucasconde.ddns.net/AuronStore/vistas/productos?pagina=<?php echo $total_paginas;?>"><i class="fas fa-angle-double-right"></i></a></li>
                <?php
                    }
                ?>
            </ul>
        </div>


        <!-- PIE DE PAGINA -->
        <?php include("../layout/footer.php"); ?>
    </main>
</body>
</html>


