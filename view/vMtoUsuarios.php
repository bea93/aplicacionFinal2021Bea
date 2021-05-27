<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Mto. Usuarios</h2>
    <div class="botones">
        <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name='Volver'>Volver</button>
        </form>
    </div>
    <div>
        <form id="busqueda" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
                <label class="formBuscar" for="descripcion">Usuarios por descripción</label>
                <hr>
                <input type="search" name="descripcion" id="descripcion" class="formBuscar" placeholder="Descripción" value="<?php
                if ($descripcionBuscada !== null) {
                    echo $descripcionBuscada;
                }
                ?>"/>
                <button type="submit" name="Buscar" class="formBuscar">Buscar</button>
            </div>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th style="text-align: center;">Descripción</th>
                        <th style="text-align: center;">Número <br> conexiones</th>
                        <th>Fecha última conexión</th>
                    </tr>
                </thead>
                <?php 
                if (isset($aUsuarios)) { 
                    ?>
                    <tbody>
                        <?php
                        foreach ($aUsuarios as $usuario => $oUsuario) {
                            $codUsuario = $oUsuario->getCodUsuario();
                            
                            if (is_null($oUsuario->getFechaHoraUltimaConexion())) {
                                $fechaUltimaConexion = "";
                            } else {
                                $fechaUltimaConexion = date('d/m/Y', $oUsuario->getFechaHoraUltimaConexion());
                            }
                            ?>
                            <tr>
                                <td><?php echo $oUsuario->getCodUsuario(); ?></td>
                                <td><?php echo $oUsuario->getDescUsuario(); ?></td>
                                <td style="text-align: center;"><?php echo $oUsuario->getNumConexiones(); ?></td>
                                <td><?php echo $fechaUltimaConexion; ?></td>
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
                    <h4 style="color: red">No se han encontrado usuarios con esa descripción</h4>
                <?php } ?>
            </table>
        </form>
    </div>