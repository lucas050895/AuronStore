<?php include('../config/conexion.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META -->
    <?php include('../layout/meta.php'); ?>
    
    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/servicios.css">
</head>
<body>
    <main>
        <!-- MENU DE NAVEGACION -->
        <?php include("../layout/nav.php"); ?>

        <div class="container_general">
            <section>
                <h2>Nuestros Servicios</h2>
                
                <p>Nos destacamos en la venta de insumos para tu celular, pero también somos los mejores en la ciudad de Hurlingham en la reparación de celulares. Cambiamos módulos, pines de carga, cambio de baterías y además realizamos liberación de cuenta y patrón.
                    <br> 
                Contamos con herramientas específicas para realizar estos trabajos, asique confianza y seguridad, son las palabras nos caracteriza al momento de realizar cualquier reparación.
                    <br>
                Contamos con un local a la calle, para que vos puedas traer tu celular y hacernos las preguntas que quieras. Además tenemos muchos artículos a la venta, subidos a este sitio para que puedas ver su precio y pedirlo sin problemas. 
                </p>
            </section>
            
            <form action="../php/enviar_correo.php" method="post">
                <h2>Envianos un mensaje</h2>
                <div>
                    <label for="nombre">Nombre <span>(*)</span></label>
                    <input type="text" id="nombre" name="nombre" placeholder="Juan" required>
                </div>
                <div>
                    <label for="apellido">Apellido <span>(*)</span></label>
                    <input type="text" id="apellido" name="apellido" placeholder="Perez" required>
                </div>
                <div>
                    <label for="celular">Celular <span>(*)</span></label>
                    <input type="number" id="celular" name="celular" placeholder="1123456789" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="juanperez@gmail.com">
                </div>
                <div>
                    <label for="mensaje">Mensaje  <span>(*)</span></label>
                    <textarea id="mensaje" name="mensaje" placeholder="Mensaje" required></textarea>
                </div>

                <input type="submit" value="Enviar">
            </form>
        </div>

        <!-- PIE DE PAGINA -->
        <?php include("../layout/footer.php"); ?>
    </main>
</body>
</html>


