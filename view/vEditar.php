<h2 class = "fh5co-heading animate-box" data-animate-effect = "fadeInLeft">Editar perfil</h2>
<div class="botones">
    <?php
    //Si el usuario no tiene una imagen se le pone una por defecto
    if ($imagenUsuario == null) {                                       
        echo '<img class="imgpreview" id="preview" src = "webroot/images/user.svg' . base64_encode($imagenUsuario) . '" width = "120px" height="120px"/>';
    } else {
        echo '<img class="imgpreview" id="preview" src = "data:image/png;base64,' . base64_encode($imagenUsuario) . '" width = "120px" height="120px"/>';
    }
    ?>
</div>
<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
    <fieldset>
        <label for="CodUsuario">Código del Usuario</label><br>
                <input class="desactivado" type="text" id="CodUsuario" name="CodUsuario" readonly value="<?php echo $codUsuario; ?>">
                <br>

                <label for="DescUsuario" >Descripción del usuario(*)</label><br>
                <input class="campos" type="text" id="DescUsuario" name="DescUsuario" value="<?php echo $descUsuario; ?>">
                <?php
                    echo $errorDescripcion!=null ? "<span style='color:#FF0000'>".$errorDescripcion."</span>" : null;
                ?>
                <br>

                <label for="NumConexiones">Número de conexiones</label><br>
                <input class="desactivado" type="text" id="NumConexiones" name="NumConexiones" readonly value="<?php echo $numConexiones; ?>">
                <br>

                <label for="FechaHoraUltimaConexion">Fecha Hora Última Conexión</label><br>
                <input class="desactivado" type="text" id="FechaHoraUltimaConexion" name="FechaHoraUltimaConexion" readonly value="<?php echo (date('d/m/Y H:i:s')); ?>">
                <br>
                <label for="imagen">Imagen</label><br>
                <input class="campos" type="file" id="imagen" name="imagen">
                <?php
                echo $errorImagen != null ? "<span style='color:#FF0000'>" . $errorImagen . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
                ?>

                <button class="logout" type="submit" name='Aceptar'>Aceptar</button>
                <button class="logout" type="submit" name='Cancelar'>Cancelar</button>
                <button class="logout" type="submit" name='CambiarPassword'>Cambiar Contraseña</button>
    </fieldset>
</form>