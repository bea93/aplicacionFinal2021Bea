<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Registrar usuario</h2>

<form name="singup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <div>
        <label for="CodUsuario">Código:</label><br>
        <input class="required" type="text" id="CodUsuario" name="CodUsuario" placeholder="Código de usuario" value="<?php
        echo (isset($_REQUEST['CodUsuario'])) ? $_REQUEST['CodUsuario'] : null;
        ?>">

    </div>
    <?php
    echo ($aErrores['CodUsuario'] != null) ? "<span style='color:#FF0000'>" . $aErrores['CodUsuario'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
    ?>
    <div>
        <label for="DescUsuario">Descripción:</label><br>
        <input class="required" type="text" id="DescUsuario" name="DescUsuario" placeholder="Descripción de usuario" value="<?php
        echo (isset($_REQUEST['DescUsuario'])) ? $_REQUEST['DescUsuario'] : null;
        ?>">

    </div>
    <?php
    echo ($aErrores['DescUsuario'] != null) ? "<span style='color:#FF0000'>" . $aErrores['DescUsuario'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
    ?>
    <div>
        <label for="Password">Contraseña:</label><br>
        <input class="required" type="password" id="Password" name="Password" value="<?php
        echo (isset($_REQUEST['Password'])) ? $_REQUEST['Password'] : null;
        ?>" placeholder="Contraseña">

    </div>          
    <?php
    echo ($aErrores['Password'] != null) ? "<span style='color:#FF0000'>" . $aErrores['Password'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
    ?>
    <div>
        <label for="PasswordConfirmacion">Repita la contraseña:</label><br>
        <input style="width: 250px;" class="required" type="password" id="PasswordConfirmacion" name="PasswordConfirmacion" value="<?php
        echo (isset($_REQUEST['PasswordConfirmacion'])) ? $_REQUEST['PasswordConfirmacion'] : null;
        ?>" placeholder="Repita la contraseña">

    </div>          
    <?php
    echo ($aErrores['PasswordConfirmacion'] != null) ? "<span style='color:#FF0000'>" . $aErrores['PasswordConfirmacion'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
    ?>
    <div >
        <button class="button" type="submit" name="Registrarse">Registrarse</button>
        <button class="button" name="Cancelar">Cancelar</button>
    </div>

</form>