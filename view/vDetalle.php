<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Detalle</h2>
<form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <button type="submit" name='volver'>Volver</button>
</form>
<div>
    <h3>Variable Session</h3>
       <pre>
           <?php
           foreach ($_SESSION as $parametros => $parametro) {
               if ($parametro == $_SESSION['fechaHoraUltimaConexionAnterior']) {
                   $parametro = date('d-m-Y', $parametro);
               }
               if (is_object($parametro)) {
                   echo "<b>" . $parametros . "</b>[ <br>";

                   $imagenPerfil = $parametro->getImagenPerfil();
                   $tabulador = "&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo $tabulador . "<b>codUsuario</b> -> " . $parametro->getCodUsuario() . "<br>";
                   echo $tabulador . "<b>password </b>-> " . $parametro->getPassword() . "<br>";
                   echo $tabulador . "<b>descUsuario</b> -> " . $parametro->getDescUsuario() . "<br>";
                   echo $tabulador . "<b>numConexiones</b> -> " . $parametro->getNumConexiones() . "<br>";
                   echo $tabulador . "<b>fechaHoraUltimaConexion</b> -> " . date('d-m-Y', $parametro->getFechaHoraUltimaConexion()) . "<br>";
                   echo $tabulador . "<b>perfil </b>->" . $parametro->getPerfil() . "<br>";
                   if ($imagenPerfil == null) {                                       //Si la imagende usuario en la tabla esta vacia le digo que me ponga una por defecto
                       echo $tabulador . '<b>Imagen Perfil</b> -> <img class="imgperfil" src = "./webroot/images/user.svg' . base64_encode($imagenPerfil) . '" width = "120px"/>';
                   } else {
                       echo $tabulador . '<b>Imagen Perfil</b> -> <img class="imgperfil" src = "data:image/png;base64,' . base64_encode($imagenPerfil) . '" width = "120px"/>';
                   }

                   $parametro = "";
                   $parametros = "]";
               }

               echo "<b>" . $parametros . "</b> ->";
               echo $parametro . "<br>";
           }
           ?>
       </pre>
    
    <h3>Variable Server</h3>
        <pre>
            <?php print_r($_SERVER);?>
        </pre>
</div>