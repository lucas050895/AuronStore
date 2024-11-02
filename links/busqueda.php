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
    <link rel="stylesheet" href="../css/busqueda.css">
    <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <?php
            include("../layout/nav.php")
        ?>


        <?php
            $busqueda = strtolower($_REQUEST['busqueda']);

            if(empty($busqueda)){
                header("Location: ../index.php");
            }
            
            // $where = '';

            $sql_registe = mysqli_query($conexion,"SELECT COUNT(*) AS total_registro FROM invitem WHERE nombre LIKE '%$busqueda%'");
            $result_register = mysqli_fetch_array($sql_registe);
            $total_registro = $result_register['total_registro'];

            $por_pagina = 30;

            if(empty($_GET['pagina'])){
                $pagina = 1;
            }else{
                $pagina = $_GET['pagina'];
            }


            $desde = ($pagina-1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $consulta = mysqli_query($conexion,"SELECT codigo, LEFT(nombre,10) AS nombre
                                                        FROM invitem
                                                        WHERE (nombre LIKE '%$busqueda%') 
                                                        LIMIT $desde,$por_pagina");

        ?>

    </main>
</body>
</html>