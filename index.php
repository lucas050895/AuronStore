<?php
    include_once('config/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auron Store</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
</head>
<body>


    <main>
        <?php
            include("layout/nav.php")
        ?>

        <div id="categories">
            <div>
                <!-- <i class="fas fa-stream"></i> -->
                <label for="cate">
                    <i class="fas fa-outdent fa-flip-horizontal"></i>
                </label>

                <select name="" id="cate" onchange="location = this.value">
                    <option value="" selected disabled="disabled">Selecione una categoria</option>
                        <?php
                            while($fila = $rubro->fetch()){
                                ?>
                                    <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
                                <?php
                            }
                        ?>
                </select>

                
            </div>
        </div>

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
                        

                        while($fila = $ofertas->fetch()){
                            ?>
                                
                                <a href="links/item.php?id=<?php echo $fila['id']; ?>">
                                    <img  src="assets/img/<?php echo $fila['codigo']; ?>.jpg" alt="<?php echo $fila['nombre']; ?>">
                                </a>
                            <?php
                        }
                    ?>


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

        <div id="articles">
            <section>
                <h2>Lo más vendidos</h2>
            </section>
            <div>
                <?php
                    while($fila = $MasVendidos->fetch()){
                        ?>
                            <div>
                                <a href="links/item.php?id=<?php echo $fila['id']; ?>">
                                    <img src="assets/img/<?php echo $fila['codigo']; ?>.jpg" alt="<?php echo $fila['nombre']; ?>">
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
                        <?php
                    }
                ?>
            </div>
            <button>
                <a href="http://lucasconde.ddns.net/AuronStore/links/productos.php">ver todos</a>
            </button>
        </div>

        <?php
            include("layout/footer.php")
        ?>
    </main>

    <script src="js/script.js"></script>
    <script src="js/nav.js"></script>
</body>
</html>