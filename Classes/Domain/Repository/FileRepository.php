<?php
namespace AndreasWolf\Modernfilelist\Domain\Repository;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ResourceStorage;


class FileRepository
{

    /**
     * @param ResourceStorage $storage
     * @param string $path
     * @return File[]
     */
    public function getByPath(ResourceStorage $storage, $path)
    {
        $folder = $storage->getFolder($path);

        return $folder->getFiles();
    }

}
