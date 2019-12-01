<?php

include TEMPLATES . 'layout/header.php';

?>
    <div class="w-50 mt-5 p-4 mx-auto rounded titlebox">
        <h1>Mostrando inmuebles</h1>
        <?php if ($auth()) { ?>
            <a class="btn btn-primary btn-sm" href="<?= $url('rent/publish');?>">Añadir inmueble</a>
            <hr>
        <?php } ?>
<?php
    foreach ($rents as $rent) {
?>
        <div style="margin: 20px; height: 200px; border: 1px solid black;">
            <div style="height: 90%;">
                <h4><?=$rent['name'];?></h4>
                <h6><?=$rent['price'];?></h6>
                <?=$rent['description'];?>
            </div>
            <div style="background-color: darkgrey; height: 10%;">
                <?php if ($auth() && $session('user_id') === $rent['user_id']) { ?>
                <a href="<?= $url('rent/modify/id/' . $rent['id']); ?>">
                    <button style="width: 20px; height: 20px; background-color: orange; color: white; font-weight: bold;">
                        <p style="margin-top: -4px;">M</p>
                    </button>
                </a>
                <a href="<?= $url('rent/delete/id/' . $rent['id']); ?>">
                    <button style="width: 20px; height: 20px; background-color: red; color: white; font-weight: bold;">
                        <p style="margin-top: -4px;">X</p>
                    </button>
                </a>
                <?php } ?>
            </div>
        </div>
<?php
    }
?>
    </div>
<?php

include TEMPLATES . 'layout/footer.php';