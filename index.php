<?php  include('config/conexion.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META / TITLE -->
    <?php include('layout/meta.php'); ?>

    <!-- ICONOS -->
    <?php include('layout/iconos.php'); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <main>
        <!-- MENU DE NAVEGACION -->
        <?php include("layout/nav.php"); ?>


        <!-- CATEGORIAS -->
        <?php include("layout/categories.php"); ?>


        <!-- OFERTAS / SLIDERS AUTOMATICO -->
        <div id="offers">
            <div>
                <section>
                    <i class="fab fa-shopify"></i>
                        <h2>Promociones</h2>
                    <i class="fab fa-shopify"></i>
                </section>

                <div class="container">
                    <div class="arrow arrow-left">
                        <i class="fas fa-chevron-circle-left"></i>
                    </div>

                    <?php
                        $ofertas = $con->query("SELECT TOP 5 *
                                                    FROM [Gestion].[dbo].[invItem]
                                                    WHERE tieneFoto = 1");
                        
                        while($fila = $ofertas->fetch()){ ?>
                            <a href="http://lucasconde.ddns.net/AuronStore/vistas/item.php?id=<?php echo $fila['id']; ?>">
                                <img  src="assets/img/image.jpg" alt="<?php echo $fila['nombre']; ?>">
                            </a>
                    <?php } ?>

                    <div class="arrow arrow-right">
                        <i class="fas fa-chevron-circle-right"></i>
                    </div>

                    <div class="dots">
                        <div class="dot">
                            <i class="far fa-dot-circle"></i>
                        </div>
                        <div class="dot">
                            <i class="far fa-circle"></i>
                        </div>
                        <div class="dot">
                            <i class="far fa-circle"></i>
                        </div>
                        <div class="dot">
                            <i class="far fa-circle"></i>
                        </div>
                        <div class="dot">
                            <i class="far fa-dot-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- LO MAS VENDIDO -->
        <div id="articles">
            <section>
                <h2>Lo más vendidos</h2>
            </section>
            <div class="container_products">
                <?php $MasVendidos = $con->query("SELECT TOP 6
                                                        invItem.id,
                                                        LEFT(invItem.nombre, 15) AS NOMBRE,
                                                        invItem.cantidadStock,
                                                        MAX(invPrecioItem.precio) AS COSTO,  
                                                        MAX(invPrecioItem.porcentajeGanacia) AS PORCENTAJE
                                                    FROM admItemComprobante
                                                    INNER JOIN invItem ON invItem.id = admItemComprobante.idItem
                                                    RIGHT JOIN invPrecioItem ON invItem.id = invPrecioItem.idItem
                                                    WHERE admItemComprobante.fechaCreacion < GETDATE() AND invItem.cantidadStock > 0
                                                    GROUP BY invItem.id, invItem.nombre, invItem.cantidadStock;");

                    while($fila = $MasVendidos->fetch()){ ?>
                        <div class="products">
                            <a href="http://lucasconde.ddns.net/AuronStore/vistas/item.php?id=<?php echo $fila['ID']; ?>">
                                <img src="assets/img/image.jpg" alt="<?php echo $fila['NOMBRE']; ?>">
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
                <?php } ?>
            </div>
            <button>
                <a href="http://lucasconde.ddns.net/AuronStore/vistas/vendidos.php">ver todos</a>
            </button>
        </div>


        <!-- PIE DE PAGINA -->
        <?php include("layout/footer.php"); ?>
    </main>

    <script src="js/script.js"></script>
    <script src="js/nav.js"></script>
</body>
</html>


