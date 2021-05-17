<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Detalle</h2>
<form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <button type="submit" name='volver'>Volver</button>
</form>
<div>
    <h3>Variable Session</h3>
       <pre>
            <?php echo "Fecha de la última conexión anterior: " . $fechaTS; ?><br>
            <?php echo "Página Anterior: " . $_SESSION['paginaAnterior']; ?><br>
            <?php echo "Página en curso sin registro: " . $_SESSION['paginaEnCursoSinRegistro']; ?><br>
            <?php echo "Código de usuario: " . $codUsuario; ?><br>
            <?php echo "Descripción de usuario: " . $descUsuario; ?><br>
            <?php echo "Perfil de usuario: " . $perfil; ?><br>
            <?php echo "Número de conexiones: " . $numConexiones;?><br>
            <?php echo "Imagen de usuario: ";?>
            <?php echo '<img class="imgpreview" id="preview" src = "data:image/png;base64,' . base64_encode($imagen) . '" width = "120px" height="120px"/>'; ?>
        </pre>
    
    <h3>Variable Server</h3>
        <pre>
            <?php print_r($_SERVER);?>
        </pre>
</div>