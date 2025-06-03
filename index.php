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

        <!-- CATEGORIAS PARA ELEGIR -->
        <div id="categories">
            <div>
                <label for="cate">
                    <i class="fas fa-outdent fa-flip-horizontal"></i>
                </label>

                <select name="" id="cate" onchange="location = this.value">
                    <option value="" selected disabled="disabled">Selecione una categoria</option>
                        <?php
                            $rubro = $con->query("SELECT *
                                                    FROM invRubro
                                                    WHERE nombre NOT LIKE 'rubro%'
                                                    ORDER BY nombre");

                            while($fila = $rubro->fetch()){ ?>
                                    <option value="vistas/rubro.php?id=<?php echo $fila['id']; ?>">
                                        <?php echo $fila['nombre']; ?>
                                    </option>
                        <?php } ?>
                </select>
            </div>
        </div>

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
                            <a href="vistas/item.php?id=<?php echo $fila['id']; ?>">
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
                <?php $MasVendidos = $con->query("SELECT invItem.id,
                                                        LEFT (invItem.nombre, 15) AS nombre,
                                                        invItem.codigo,
                                                        invItem.tienefoto,
                                                        invPrecioItem.precio,
                                                        LEFT (invPrecioItem.precio * 1.21, 7) AS C_IVA
                                                    FROM invItem
                                                    RIGHT JOIN invPrecioItem
                                                    ON invItem.id = invPrecioItem.idItem
                                                    WHERE referenciaArea = 'VTA'
                                                        AND invItem.tienefoto = 1
                                                        AND idrubro = 'EE27FC88-067F-4CE9-8DE2-280C1976C9EB' ");

                    while($fila = $MasVendidos->fetch()){ ?>
                        <div class="products">
                            <a href="vistas/item.php?id=<?php echo $fila['id']; ?>">
                                <img src="assets/img/image.jpg" alt="<?php echo $fila['nombre']; ?>">
                                <div>
                                    <p>
                                        <?php echo $fila['nombre']; ?>
                                    </p>
                                    <hr>
                                    <p>
                                        <?php echo $fila['C_IVA']; ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                <?php } ?>
            </div>
            <button>
                <a href="http://lucasconde.ddns.net/AuronStore/vistas/productos.php">ver todos</a>
            </button>
        </div>

        <!-- PIE DE PAGINA -->
        <?php include("layout/footer.php"); ?>
    </main>

    <script src="js/script.js"></script>
    <script src="js/nav.js"></script>
</body>
</html>