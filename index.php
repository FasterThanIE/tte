<?php

    require_once "src/TTE.php";

    $tte = new TTE();

    $tte->render("test.php", [
        'world' => 'test',
        'ime' => 'Jeca'
    ]);