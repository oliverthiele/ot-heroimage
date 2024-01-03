<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Heroimage',
    'description' => 'This content element can output larger image widths than normal elements and is therefore suitable for outputting images across the entire screen width.',
    'category' => 'plugin',
    'author' => 'Oliver Thiele',
    'author_email' => 'mail@oliver-thiele.de',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
