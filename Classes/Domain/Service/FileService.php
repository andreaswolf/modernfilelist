<?php
namespace AndreasWolf\Modernfilelist\Domain\Service;

use AndreasWolf\Modernfilelist\Domain\Repository\FileRepository;


class FileService
{

    /**
     * @var FileRepository
     */
    protected $fileRepository;

    public function injectFileRepository(\AndreasWolf\Modernfilelist\Domain\Repository\FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function getByPath($storage, $path)
    {
        return $this->fileRepository->getByPath($storage, $path);
    }

}
