<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <title>Rentit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Rentit</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= $url(); ?>">Inicio</a>
            </li>
            <?php
                if ($auth()) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url('user/logout'); ?>">Salir</a>
                </li>
            <?php
                } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url('user/login'); ?>">Ingresar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url('user/register'); ?>">Registrar</a>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>