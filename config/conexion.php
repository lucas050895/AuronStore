<?php
    // $servidor = "localhost";
    // $nombreBD = "gestion";
    // $usuario = "root";
    // $password = "";

    // $conexion = new mysqli($servidor,$usuario,$password,$nombreBD);

    // if($conexion -> connect_error){
    //     die("Error en la conexion de la BD");
    // }




    $server = 'lucasconde.ddns.net';
    $database = 'Gestion';
    $username = 'sa';
    $password = 'Idm123456';

    try{
        $con = new PDO("sqlsrv:Server=$server;Database=$database",$username,$password);

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error:" . $e->getMessage();
    }



    $rubro = $con->query("SELECT *
                            FROM invRubro");

    $ofertas = $con->query("SELECT TOP 5 *
                                FROM [Gestion].[dbo].[invItem]
                                WHERE tieneFoto = 1");


    $MasVendidos = $con->query("SELECT invItem.id,
                                    LEFT (invItem.nombre, 15) AS nombre,
                                    invItem.codigo,
                                    invItem.tienefoto,
                                    invPrecioItem.precio,
                                    LEFT (invPrecioItem.precio * 1.21, 7) AS C_IVA
                                FROM invItem
                                RIGHT JOIN invPrecioItem
                                ON invItem.id = invPrecioItem.idItem
                                WHERE invPrecioItem.precio > 10 AND invItem.tienefoto = 1 AND idrubro = 'EE27FC88-067F-4CE9-8DE2-280C1976C9EB' ")


?>