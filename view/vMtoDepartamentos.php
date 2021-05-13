<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Mto. Departamentos</h2>
    <div class="botones">
        <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name='Volver'>Volver</button>
        </form>
    </div>
    <div>
        <form id="busqueda" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
                <label for="codigo">Descripción: </label>
                <input type="search" name="descripcion" placeholder="Descripción" value="<?php
                if (isset($_REQUEST['descripcion'])) {
                    echo $_REQUEST['descripcion'];
                }
                ?>"/>
                <button type="submit" name="Buscar">Buscar</button>
            </div>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Volumen negocio</th>
                        <th>Fecha creación</th>
                        <th>Fecha baja</th>
                        <th colspan="2">Opciones</th>
                    </tr>
                </thead>
                <?php 
                if (count($arrayDepartamentos) > 0) { 
                    ?>
                    <tbody>
                        <?php
                        foreach ($arrayDepartamentos as $departamento => $oDepartamento) {
                            $codigoDep = $oDepartamento->getCodDepartamento();
                            
                            if (is_null($oDepartamento->getFechaBaja())) {
                                $fechaBaja = "";
                            } else {
                                $fechaBaja = date('d/m/Y', $oDepartamento->getFechaBaja());
                            }
                            ?>
                            <tr>
                                <td><?php echo $oDepartamento->getCodDepartamento(); ?></td>
                                <td><?php echo $oDepartamento->getDescDepartamento(); ?></td>
                                <td><?php echo $oDepartamento->getVolumenNegocio(); ?></td>
                                <td><?php echo date('d/m/Y', $oDepartamento->getFechaCreacion()); ?></td>
                                <td><?php echo $fechaBaja; ?></td>
                                <td>
                                    <button class="mtoDepartamentos" name="modificarDepartamento" value="<?php echo $codigoDep ?>"><i class='fas fa-pencil-alt'></i></button>
                                </td>
                                <td>
                                    <button class="mtoDepartamentos" name="eliminarDepartamento" value="<?php echo $codigoDep ?>"><i class='far fa-trash-alt'></i></button>                           
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                    <?php
                } else {
                    ?>
                    <h4 style="color: red">No se ha encontrado departamentos con esa descripción</h4>
                <?php } ?>

            </table>
        </form>
    </div>