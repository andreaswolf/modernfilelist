<?php
namespace AndreasWolf\Modernfilelist\Controller;

use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;


class AjaxController extends ActionController
{

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
        $folder = $storage->getFolder($path);

        $files = $folder->getFiles();

        $filesArray = [];
        foreach ($files as $file) {
            $filesArray[] = [
                'name' => $file->getName(),
            ];
        }
        $this->view->assignMultiple([
            'fileCount' => count($files),
            'files' => $filesArray
        ]);
        $this->view->setVariablesToRender(['files', 'fileCount', 'links']);
    }

}
