<?php
namespace AndreasWolf\Modernfilelist\Controller;

use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;


class FileListController extends ActionController
{

    /**
     * @var ResourceStorage
     */
    protected $storage;

    /**
     * @var string
     */
    protected $path;

    protected function initializeAction()
    {
        parent::initializeAction();
    }


    public function indexAction()
    {
    }
}
