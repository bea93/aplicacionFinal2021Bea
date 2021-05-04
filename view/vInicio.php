<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Inicio</h2>
<article>
    <h3>¡Bienvenid@ <?php echo $descUsuario; ?>!</h3>
    <h4><?php echo ($numConexiones > 1) ? "Te has conectado " . $numConexiones . " veces.<br>La última conexión fue el " . date('d/m/Y', $ultimaConexionAnterior) . " a las " . date('H:i:s', $ultimaConexionAnterior)  : "Esta es la primera vez que te conectas." ?></h4>
</article>
<div>
    <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button class="logout" type="submit" name='cerrarSesion'>Cerrar Sesión</button>
        <button class="logout" type="submit" name='detalle'>Detalle</button>
        <button class="logout" type="submit" name='editar'>Editar Perfil</button><br>
        <button class="logout" id="borrarCuenta" type="submit" name='borrarCuenta'>Borrar Cuenta</button><br>
        <button class="logout" id="mtoDep" type="submit" name='mtoDepartamentos'>Mto Departamentos</button>
        <button class="logout" id="rest" type="submit" name='rest'>REST</button>
    </form>
</div>