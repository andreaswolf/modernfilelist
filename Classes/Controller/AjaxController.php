<?php
namespace AndreasWolf\Modernfilelist\Controller;

use AndreasWolf\Modernfilelist\Domain\Service\FileService;
use TYPO3\CMS\Core\Resource\AbstractFile;
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
        $files = $this->fileService->getFilesArrayByPath($storage, $path);

        $this->view->assignMultiple([
            'fileCount' => count($files),
            'files' => array_values($files)
        ]);
        $this->view->setVariablesToRender(['files', 'fileCount', 'links']);
    }

    /**
     * @param AbstractFile $file
     */
    public function deleteFileAction(\TYPO3\CMS\Core\Resource\AbstractFile $file)
    {
        try {
            $file->delete();

            $this->view->assign('success', true);
            $this->view->setVariablesToRender(['success', 'file', 'filename']);
        } catch (\Exception $e) {
            $this->view->assignMultiple([
                'error' => $e->getMessage(),
                'success' => false,
            ]);

            $this->view->setVariablesToRender(['success', 'error', 'file', 'filename']);
        }
        $this->view->assignMultiple([
            'file' => $file->getCombinedIdentifier(),
            'filename' => $file->getName()
        ]);
    }

}
