<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Mto. Departamentos</h2>
    <div class="botones">
        <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name='Volver'>Volver</button>
        </form>
    </div>
    <div>
        <form id="busqueda" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
                <fieldset>
                    <legend>Busca departamento por descripción</legend>
                    <input type="search" name="descripcion" placeholder="Descripción" value="<?php
                    if ($descBuscada !== null) {
                        echo $descBuscada;
                    }
                    ?>"/>
                    <button type="submit" name="Buscar">Buscar</button><br><br>
                </fieldset>    
                <button type="submit" name="Alta">Añadir</button>
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
                        <th colspan="4">Opciones</th>
                    </tr>
                </thead>
                <?php 
                if (isset($arrayDepartamentos)) { 
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
                                    <button class="mtoDepartamentos" type="submit" name="modificarDepartamento" value="<?php echo $codigoDep ?>"><i class='fas fa-pencil-alt'></i></button>
                                </td>
                                <td>
                                    <button class="mtoDepartamentos" type="submit" name="eliminarDepartamento" value="<?php echo $codigoDep ?>"><i class='far fa-trash-alt'></i></button>                           
                                </td>
                                <td>
                                    <?php if (is_null($oDepartamento->getFechaBaja())) {?>
                                        <button class="mtoDepartamentos" type="submit" name="bajaLogica" value="<?php echo $codigoDep ?>"><i class="fas fa-arrow-down" style="color:red"></i></i></button>
                                    <?php } else {?>
                                        <button class="mtoDepartamentos" type="submit" name="rehabilitar" value="<?php echo $codigoDep ?>"><i class="fas fa-arrow-up" style="color:green"></i></i></button>
                                    <?php }?>                        
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