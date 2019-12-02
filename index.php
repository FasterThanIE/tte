<?php

    require_once "src/TTE.php";

    $tte = new TTE();

    $tte->render("test.php", [
        'world' => 'test',
        'ime' => 'Jeca',
        'nesto' => 'Test 2'
    ])->useSessionData();