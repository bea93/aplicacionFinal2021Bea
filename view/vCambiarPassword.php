<h2 class = "fh5co-heading animate-box" data-animate-effect = "fadeInLeft">Cambiar Contraseña</h2>
<form name="formularioCambiarPassword" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
    <div>
        <label for="Password">Contraseña Actual</label><br>
        <input class="campos" type="password" id="Password" name="Password" value="<?php
        echo (isset($_REQUEST['Password'])) ? $_REQUEST['Password'] : null;
        ?>">

        <?php
        echo ($aErrores['Password'] != null) ? "<span style='color:#FF0000'>" . $aErrores['Password'] . "</span>" : null;
        ?>
        <br>

        <label for="NuevaPassword">Nueva Contraseña</label><br>
        <input class="campos" type="password" id="NuevaPassword" name="NuevaPassword" value="<?php
        echo (isset($_REQUEST['NuevaPassword'])) ? $_REQUEST['NuevaPassword'] : null;
        ?>">

        <?php
        echo ($aErrores['NuevaPassword'] != null) ? "<span style='color:#FF0000'>" . $aErrores['NuevaPassword'] . "</span>" : null;
        ?>
        <br>

        <label for="RepetirPassword">Repetir Contraseña</label><br>
        <input class="campos" type="password" id="RepetirPassword" name="RepetirPassword" value="<?php
        echo (isset($_REQUEST['RepetirPassword'])) ? $_REQUEST['RepetirPassword'] : null;
        ?>">

        <?php
        echo ($aErrores['RepetirPassword'] != null) ? "<span style='color:#FF0000'>" . $aErrores['RepetirPassword'] . "</span>" : null;
        ?>
        <br>
    </div>
    <div>
        <button class="logout" type="submit" name='Aceptar'>Aceptar</button>
                <button class="logout" type="submit" name='Cancelar'>Cancelar</button>
    </div>
</form>