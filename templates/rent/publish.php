<?php

include TEMPLATES . 'layout/header.php';

?>
<div class="w-50 mt-5 p-4 mx-auto rounded titlebox">
    <h1>Publicar un nuevo inmueble</h1>
    <p><?= $var('message'); ?></p>
    <div class="mt-4 row">
        <form class="w-100" method="POST" action="<?= $url('rent/publish'); ?>">
            <div class="col-md-12">Nombre<br><input style="width: 50%;" type="text" name="name" required placeholder="Introduce el nombre del inmueble"></div>
            <div class="col-md-12">Descripción<br><textarea style="width: 50%;" name="description" required placeholder="Introduce el nombre del inmueble"></textarea></div>
            <div class="col-md-12">Precio<br><input style="width: 50%;" type="text" name="price" required placeholder="999 €"></div>
            <button class="mt-1 btn btn-primary" type="submit">ENVIAR</button>
        </form>
    </div>
</div>
<?php

include TEMPLATES . 'layout/footer.php';