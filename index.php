<?php

require __DIR__.DIRECTORY_SEPARATOR.'base.php';

$title = 'O2 TV Channels Editor';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= fileVersion('css/styles.css') ?>" rel="stylesheet" />
    <link href="<?= fileVersion('css/my-styles.css') ?>" rel="stylesheet" />
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><?= $title ?></a>
<!--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>-->
<!--        <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
<!--            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">-->
<!--                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>-->
<!--                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>-->
<!--                <li class="nav-item dropdown">-->
<!--                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>-->
<!--                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">-->
<!--                        <li><a class="dropdown-item" href="#">Action</a></li>-->
<!--                        <li><a class="dropdown-item" href="#">Another action</a></li>-->
<!--                        <li><hr class="dropdown-divider" /></li>-->
<!--                        <li><a class="dropdown-item" href="#">Something else here</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>
</nav>
<!-- Page content-->
<div class="container">
    <div class="text-center mt-5 mb-5">
        <input type="file"> <button class="btn btn-primary">Nahrát soubor s kanály</button>
    </div>
    <div id="channels">
        <?php
//        setAllChannelsInvisible();
        $channels = getChannels();
//        saveChannels($channels);
        if (!empty($channels)) {
            echo generateChannelsTable($channels);
        }
        ?>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- Core theme JS-->
<script src="<?= fileVersion('js/scripts.js') ?>"></script>
</body>
</html>