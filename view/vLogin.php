<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Iniciar sesión</h2>
    <form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-login">
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