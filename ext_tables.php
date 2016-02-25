<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'AndreasWolf.Modernfilelist',
        'file',
        'modernlist',
        '',
        array(
            'FileList' => 'index'
        ),
        array(
            'access' => 'user,group',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/BackendModule.xlf',
        )
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler(
        'modernfilelist::getFiles',
        'AndreasWolf\\Modernfilelist\\Ajax\\FileListEndpoint->getFiles');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler(
        'modernfilelist::deleteFile',
        'AndreasWolf\\Modernfilelist\\Ajax\\FileListEndpoint->deleteFile');
}
