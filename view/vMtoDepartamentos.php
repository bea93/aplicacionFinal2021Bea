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
                    <label class="formBuscar" for="descripcion">Busca departamento por descripción</label>
                    <hr>
                    <input type="search" name="descripcion" id="descripcion" class="formBuscar" placeholder="Descripción" value="<?php
                    if ($descBuscada !== null) {
                        echo $descBuscada;
                    }
                    ?>"/>
                    <button type="submit" name="Buscar" class="formBuscar">Buscar</button>
                    <br>
                    <input type="radio" id="Todos" class="formBuscar" name="CriterioBusqueda" value="Todos" <?php echo!isset($criterioBusqueda) ? 'checked' : ($criterioBusqueda == 'Todos' ? 'checked' : null) ?> >
                    <label for="Todos">Todos</label>
                    <span>&nbsp;&nbsp;&nbsp;</span>

                    <input type="radio" id="Baja" class="formBuscar" name="CriterioBusqueda" value="Baja" <?php echo isset($criterioBusqueda) && $criterioBusqueda == 'Baja' ? 'checked' : null ?> >
                    <label for="Baja">Departamentos dados de baja</label>
                    <span>&nbsp;&nbsp;&nbsp;</span>

                    <input type="radio" id="Alta" class="formBuscar" name="CriterioBusqueda" value="Alta" <?php echo isset($criterioBusqueda) && $criterioBusqueda == 'Alta' ? 'checked' : null ?> >
                    <label for="Alta">Departamentos dados de alta</label>
                    <hr>
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
                        <th colspan="3" style="text-align: center;">Opciones</th>
                    </tr>
                </thead>
                <?php 
                if (isset($aDepartamentos)) { 
                    ?>
                    <tbody>
                        <?php
                        foreach ($aDepartamentos as $departamento => $oDepartamento) {
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
        <form id="formularioPaginacion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table>
                <tr>
                    <td><button <?php echo ($paginaActual == 1 ? "hidden" : null); ?> type="submit" value="1" name="paginaInicial"><i class="fas fa-angle-double-left"></i></button></td>
                    <td><button <?php echo ($paginaActual == 1 ? "hidden" : null); ?> type="submit" value="<?php echo $paginaActual - 1; ?>" name="retrocederPagina"><i class="fas fa-angle-left"></i></button></td>
                    <td><?php echo $paginaActual . " de " . $paginasTotales; ?></td>
                    <td><button <?php echo ($paginaActual >= $paginasTotales ? "hidden" : null); ?> type="submit" value="<?php echo $paginaActual + 1; ?>" name="avanzarPagina"><i class="fas fa-angle-right"></i></button></td>
                    <td><button <?php echo ($paginaActual >= $paginasTotales ? "hidden" : null); ?> type="submit" value="<?php echo $paginasTotales ?>" name="paginaFinal"><i class="fas fa-angle-double-right"></i></button></td>
                </tr>
            </table>
        </form>
    </div>