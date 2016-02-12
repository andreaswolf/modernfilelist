<?php
namespace AndreasWolf\Modernfilelist\Controller;

use AndreasWolf\Modernfilelist\Domain\Service\FileService;
use AndreasWolf\Modernfilelist\Serializer\FileArraySerializer;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;


class AjaxController extends ActionController
{

    /**
     * @var FileService
     */
    protected $fileService;

    public function injectFileService(\AndreasWolf\Modernfilelist\Domain\Service\FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    protected function resolveViewObjectName()
    {
        return 'TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView';
    }

    /**
     * @param ResourceStorage $storage
     * @param string $path
     */
    public function getFilesAction(\TYPO3\CMS\Core\Resource\ResourceStorage $storage, $path)
    {
        $files = $this->fileService->getByPath($storage, $path);

        $fileSerializer = new FileArraySerializer();

        $filesArray = [];
        foreach ($files as $file) {
            $filesArray[] = $fileSerializer->serialize($file);
        }
        $this->view->assignMultiple([
            'fileCount' => count($files),
            'files' => $filesArray
        ]);
        $this->view->setVariablesToRender(['files', 'fileCount', 'links']);
    }

}
