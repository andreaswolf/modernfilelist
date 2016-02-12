<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "modernfilelist".
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Modern file list',
    'description' => 'A more modern backend file list module',
    'category' => 'backend',
    'version' => '0.0.1',
    'state' => 'alpha',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearcacheonload' => true,
    'author' => 'Andreas Wolf',
    'author_email' => 'dev@a-w.io',
    'author_company' => '',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.0-7.99.99'
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
);

