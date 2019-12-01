<?php

include TEMPLATES . 'layout/header.php';

?>
<div class="w-50 mt-5 p-4 mx-auto rounded titlebox">
    <h1>Registro de nuevo usuario</h1>
    <h5>Por favor, introduce tus datos en los campos correspondientes</h5>
    <p><?= $var('message'); ?></p>
    <div class="mt-4 row">
        <form class="w-100" method="POST" action="<?= $url('user/register'); ?>">
            <div class="col-md-12">Usuario<br><input style="width: 50%;" type="text" name="username" required placeholder="Introduce tu usuario"></div>
            <div class="col-md-12">Contraseña<br><input style="width: 50%;" class="pw" type="password" name="pw1" placeholder="Introduce tu contraseña"></div>
            <div class="col-md-12">Vuelve a introducir tu contraseña<br><input style="width: 50%;" class="pw" type="password" required name="pw2" placeholder="Vuelve a introducr tu contraseña"></div>
            <button class="mt-1 btn btn-primary" type="submit">ENVIAR</button>
        </form>
    </div>
</div>
<?php

include TEMPLATES . 'layout/footer.php';