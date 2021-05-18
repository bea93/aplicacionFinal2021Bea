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
                <button type="submit" name="Importar">Importar</button>
                <button type="submit" name="Exportar">Exportar</button>
            </div>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th style="text-align: center;">Descripción</th>
                        <th style="text-align: center;">Volumen negocio</th>
                        <th>Fecha creación</th>
                        <th>Fecha baja</th>
                        <th colspan="4" style="text-align: center;">Opciones</th>
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
                                <td style="text-align: center;"><?php echo $oDepartamento->getVolumenNegocio(); ?></td>
                                <td><?php echo date('d/m/Y', $oDepartamento->getFechaCreacion()); ?></td>
                                <td><?php echo $fechaBaja; ?></td>
                                <td>
                                    <button class="mtoDepartamentos" type="submit" name="Modificar" value="<?php echo $codigoDep ?>"><i class='fas fa-pencil-alt'></i></button>
                                </td>
                                <td>
                                    <button class="mtoDepartamentos" type="submit" name="Eliminar" value="<?php echo $codigoDep ?>"><i class='far fa-trash-alt'></i></button>                           
                                </td>
                                <td>
                                    <?php if (is_null($oDepartamento->getFechaBaja())) {?>
                                        <button class="mtoDepartamentos" type="submit" name="Baja" value="<?php echo $codigoDep ?>"><i class="fas fa-arrow-down" style="color:red"></i></button>
                                    <?php } else {?>
                                        <button class="mtoDepartamentos" type="submit" name="Rehabilitar" value="<?php echo $codigoDep ?>"><i class="fas fa-arrow-up" style="color:green"></i></button>
                                    <?php }?>                        
                                </td>
                            </tr>
                            <tr>
                                <td></td>
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