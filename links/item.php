<?php
    include('../config/conexion.php');

    if(isset($_GET['id'])){


        $resultado = $con -> query('SELECT * FROM invItem WHERE id = "'.$_GET['id'].'" ');

        if(mysqli_num_rows($MasVendidos) > 0){
            $fila = mysqli_fetch_row($MasVendidos);
        }else{
            header("Location: ../index.php");
        }


    }else{
        header("Location: ../index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
            <div>
                <!-- DESCRIPCION/NOMBRE -->
                <h2><?php echo $fila[1] ?></h2>
                <!-- PRECIO VENTA-->
                <h2><?php echo $fila[19] ?></h2>
                <!-- CODIGO -->
                <p><?php echo $fila[0] ?></p>
            </div>
</body>
</html>