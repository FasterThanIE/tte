<?php

    require_once "src/TTE.php";

    $tte = new TTE();

    $tte->render("xasxasxas.php", [
        'world' => 'test',
        'ime' => 'Jeca',
        'nesto' => 'Test 2',
        'axsx' => 'Tx'
    ])->useSessionData();