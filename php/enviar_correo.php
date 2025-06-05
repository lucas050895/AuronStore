<?php
    /*GUARDA CADA VALOR INGRESADO EN EL FORMULARIO EN CADA VARIABLE*/
    $destinatario = "stlucasconde@gmail.com";
    $nombre = $_POST["nombre"];
    $celular = $_POST["celular"];
    $email = $_POST["email"];
    $mensaje = $_POST["mensaje"];

    $contenido = "Nombre: " . $nombre . "\nCorreo: " . $email ."\nCelular: " . $celular .  "\nMensaje: " . $mensaje ."\n\nEste mensaje fue enviado desde el sitio web.";

    mail($destinatario,"Mensaje del Sitio Web", $contenido, "From: $email");

    /*REDIRECCIONA A LA PAGINA DE INICIO*/
    header("Location: ../index.php")
?>