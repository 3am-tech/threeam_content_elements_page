<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content Elements Page',
    'description' => 'Are you tired of manually creating content elements pages on your TYPO3 website? Introducing our innovative TYPO3 extension that simplifies the process by automatically generating a dedicated page containing all unique content elements present across your site.',
    'category' => 'plugin',
    'author' => 'Mohsin Khan',
    'author_email' => 'mohsin@3am-tech.com',
    'state' => 'beta',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
