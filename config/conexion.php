<?php
    $server = 'DESKTOP-BJCP0I9';
    $database = 'Gestion';
    $username = 'sa';
    $password = 'Veinte.2025';

    try{
        $con = new PDO("sqlsrv:Server=$server;Database=$database",$username,$password);

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error:" . $e->getMessage();
    }
?>