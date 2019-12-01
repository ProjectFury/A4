<?php

include TEMPLATES . 'layout/header.php';

?>
<div class="w-50 mt-5 p-4 mx-auto rounded titlebox">
    <h1>Login</h1>
    <h5>Por favor, introduce tus datos en los campos correspondientes</h5>
    <p><?= $var('message'); ?></p>
    <div class="mt-4 row">
        <form class="w-100" method="POST" action="<?= $url('user/login'); ?>">
            <div class="mt-1 row">
                <div class="col-md-6">Usuario<br><input type="text" name="username" placeholder="Introduce tu usuario"></div>
                <div class="col-md-6">Contraseña<br><input type="password" name="pw1" placeholder="Introduce tu contraseña"></div>
            </div>
            <button class="mt-1 btn btn-primary" type="submit">Acceder</button>
        </form>
    </div>
</div>

<?php

include TEMPLATES . 'layout/footer.php';