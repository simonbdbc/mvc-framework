<?php
return (object) [
    'host' => 'localhost',
    'username' => 'root',
    'pass' => '0000',
    'database' => 'mvc-framework',
    'app_info' => [
        'appName'=>"App Name",
        'appURL'=> "http://yourURL/#/",
    ],
    'module_directory' => 'modules/',
    // le premier est le module par default.
    // nom du module => nom utilisable.
    'app_modules' => [
        'home'=> "accueil",
        'salarie'=> "salariés",
    ]
];