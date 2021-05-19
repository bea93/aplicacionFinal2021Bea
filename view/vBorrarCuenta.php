<h2 class = "fh5co-heading animate-box" data-animate-effect = "fadeInLeft">Borrar Cuenta</h2>
<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
    <fieldset>
        <h3 style="color: red">¿Seguro que quieres borrar el usuario <?php echo $descUsuario ?> ?</h3>
        <label for="CodUsuario">Código del Usuario</label><br>
        <input class="desactivado" type="text" id="CodUsuario" name="CodUsuario" readonly value="<?php echo $codUsuario; ?>">
        <br>

        <label for="DescUsuario" >Descripción del usuario</label><br>
        <input class="desactivado" type="text" id="DescUsuario" name="DescUsuario" readonly value="<?php echo $descUsuario; ?>">
        <br>

        <label for="NumConexiones">Número de conexiones</label><br>
        <input class="desactivado" type="text" id="NumConexiones" name="NumConexiones" readonly value="<?php echo $numConexiones; ?>">
        <br>

        <label for="FechaHoraUltimaConexion">Fecha Hora Última Conexión</label><br>
        <input class="desactivado" type="text" id="FechaHoraUltimaConexion" name="FechaHoraUltimaConexion" readonly value="<?php echo (date('d/m/Y H:i:s')); ?>">
        <br>

        <button class="logout" type="submit" name='Aceptar'>Aceptar</button>
        <button class="logout" type="submit" name='Cancelar'>Cancelar</button>
    </fieldset>
</form>