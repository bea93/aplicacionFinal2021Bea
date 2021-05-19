<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Modificar Departamento</h2>
<div>
    <form name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
        <div>
            <label for="CodDepartamento">Código de departamento</label><br>
            <input class="desactivado" size="4" type="text" id="CodDepartamento" name="CodDepartamento" readonly value="<?php echo $codDep; ?>">
            <br>

            <label for="DescDepartamento" >Descripción de departamento</label><br>
            <input type="text" size="30" id="DescDepartamento" name="DescDepartamento" value="<?php echo isset($_REQUEST['DescDepartamento']) ? $_REQUEST['DescDepartamento'] : $descDep; ?>">
            <?php echo isset($aErrores['DescDepartamento']) ? '<p style="color: red;">' . $aErrores['DescDepartamento'] . '</p>' : null; ?>
            <br>

            <label for="FechaCreacion">Fecha de creación</label><br>
            <input class="desactivado" size="10" type="text" id="FechaCreacion" name="FechaCreacion" readonly value="<?php echo date('d/m/Y', $fechaCreacion); ?>">
            <br>

            <label for="VolumenNegocio">Volumen de negocio</label><br>
            <input type="text" size="5" id="VolumenNegocio" name="VolumenNegocio" value="<?php echo isset($_REQUEST['VolumenNegocio']) ? $_REQUEST['VolumenNegocio'] : $volumen; ?>">
            <?php echo isset($aErrores['VolumenNegocio']) ? '<p style="color: red;">' . $aErrores['VolumenNegocio'] . '</p>' : null; ?>
            <br>
            
            <label for="FechaBaja">Fecha de Baja</label><br>
            <input type="text" class="desactivado" readonly id="FechaBaja" name="FechaBaja" value="<?php echo isset($fechaBaja) ?  $fechaBaja : null; ?>">
            <br>
        </div>
        <div>
            <button class="logout" type="submit" name='Aceptar'>Aceptar</button>
            <button class="logout" type="submit" name='Cancelar'>Cancelar</button>
        </div>
    </form>
</div>