<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Añadir Departamento</h2>

<form name="singup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <div>
        <label for="CodDepartamento">Código:</label><br>
        <input class="required" type="text" id="CodDepartamento" name="CodDepartamento" placeholder="Código de departamento" value="<?php
        echo (isset($_REQUEST['CodDepartamento'])) ? $_REQUEST['CodDepartamento'] : null;
        ?>">

    </div>
    <?php
    echo ($aErrores['CodDepartamento'] != null) ? "<span style='color:#FF0000'>" . $aErrores['CodDepartamento'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
    ?>
    <div>
        <label for="DescDepartamento">Descripción:</label><br>
        <input class="required" type="text" id="DescDepartamento" name="DescDepartamento" placeholder="Descripción de departamento" value="<?php
        echo (isset($_REQUEST['DescDepartamento'])) ? $_REQUEST['DescDepartamento'] : null;
        ?>">

    </div>
    <?php
    echo ($aErrores['DescDepartamento'] != null) ? "<span style='color:#FF0000'>" . $aErrores['DescDepartamento'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
    ?>
    <div>
        <label for="Volumen">Contraseña:</label><br>
        <input class="required" type="text" id="Volumen" name="Volumen" value="<?php
        echo (isset($_REQUEST['Volumen'])) ? $_REQUEST['Volumen'] : null;
        ?>" placeholder="Volumen Negocio">

    </div>          
    <?php
    echo ($aErrores['Volumen'] != null) ? "<span style='color:#FF0000'>" . $aErrores['Volumen'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
    ?>
    <div >
        <button class="button" type="submit" name="Alta">Añadir</button>
        <button class="button" name="Cancelar">Cancelar</button>
    </div>

</form>