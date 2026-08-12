<?php

$EM_CONF['ot_heroimage'] = [
    'title' => 'Heroimage',
    'description' => 'This content element can output larger image widths than normal elements and is therefore suitable for outputting images across the entire screen width.',
    'category' => 'plugin',
    'author' => 'Oliver Thiele',
    'author_email' => 'mail@oliver-thiele.de',
    'state' => 'stable',
    'version' => '6.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '14.3.0-14.99.99',
            'php' => '8.4.0-8.99.99',
            'ot_irrebuttons' => '5.0.0-5.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
