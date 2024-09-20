<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content Elements Page',
    'description' => 'Are you tired of manually creating content elements pages on your TYPO3 website? Introducing our innovative TYPO3 extension that simplifies the process by automatically generating a dedicated page containing all unique content elements present across your site.',
    'category' => 'misc',
    'author' => 'Mohsin Khan',
    'author_email' => 'mohsin@3am-tech.com',
    'author_company' => '3AM Technologies',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '1.1.4',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Threeam\\ThreeamContentElementsPage\\' => 'Classes/',
        ],
    ],
];
