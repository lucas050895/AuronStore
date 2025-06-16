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
                            <option value="http://lucasconde.ddns.net/AuronStore/vistas/rubros?id=<?php echo $fila['id']; ?>">
                                <?php echo $fila['nombre']; ?>
                            </option>
                <?php } ?>
        </select>
    </div>
</div>