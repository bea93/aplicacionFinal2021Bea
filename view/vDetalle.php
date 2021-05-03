<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Detalle</h2>
<div>
    <h3>Variable Session</h3>
        <pre>
            <?php print_r($_SESSION);?>
        </pre>
    <h3>Variable Cookies</h3>
        <pre>
            <?php print_r($_COOKIE);?>
        </pre>
    <h3>Variable Server</h3>
        <pre>
            <?php print_r($_SERVER);?>
        </pre>
    <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button type="submit" name='volver'>Volver</button>
    </form>
</div>