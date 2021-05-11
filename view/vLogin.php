<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Iniciar sesión</h2>
<div style="width: 30%; float: left;">
    <form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div>
            <label for="CodUsuario">Usuario:</label><br>
            <input class="required" type="text" id="CodUsuario" name="CodUsuario" 
                   value="<?php
            echo (isset($_REQUEST['CodUsuario'])) ? $_REQUEST['CodUsuario'] : null;?>">
        </div>
        <div>
            <label for="Password">Contraseña</label><br>
            <input class="required" type="password" id="Password" name="Password" value="<?php
            echo (isset($_REQUEST['Password'])) ? $_REQUEST['Password'] : null;?>">
        </div>
        <div>
            <button type="submit" name="IniciarSesion">Iniciar sesión</button>
            <button type="submit" name="Registrarse">Registrarse</button>
        </div>
    </form>
</div>
<div style="width: 70%; float: left;">
    <div>
        <img src="webroot/images/almacenamiento.JPG" alt="Estructura almacenamiento" width="200" height="250"/>
        <a href="doc/navegacion.pdf" target="blank"><img src="webroot/images/arbol.jpg" alt="Árbol de navegación" width="200" height="250"/></a>
        <a href="doc/diagramaCasos.pdf" target="blank"><img src="webroot/images/casosUso.jpg" alt="Diagrama de casos de uso" width="200" height="250"/></a>
    </div>
    <div>
        <a href="doc/diagramaClases.pdf" target="blank"><img src="webroot/images/diagramaClases.jpg" alt="Diagrama de clases" width="200" height="250"/></a>
        <a href="doc/ficheros.pdf" target="blank"><img src="webroot/images/ficheros.jpg" alt="Ficheros" width="200" height="250"/></a>
        <a href="doc/modeloDatos.pdf" target="blank"><img src="webroot/images/modeloDatos.jpg" alt="Modelo de datos" width="200" height="250"/></a>
    </div>
</div>