<?php
namespace AndreasWolf\Modernfilelist\Controller;

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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

    /**
     * @var ResourceFactory
     */
    protected $resourceFactory;


    public function injectResourceFactory(\TYPO3\CMS\Core\Resource\ResourceFactory $resourceFactory)
    {
        $this->resourceFactory = $resourceFactory;
    }


    protected function initializeAction()
    {
        parent::initializeAction();

        list($storage, $path) = explode(':', GeneralUtility::_GP('id'));

        if ((int)$storage > 0) {
            $this->storage = $this->resourceFactory->getStorageObject((int)$storage);
            $this->path = $path;
        }
    }


    public function indexAction()
    {
        $this->view->assignMultiple([
            'storage' => $this->storage,
            'path' => $this->path,
        ]);
    }

}
