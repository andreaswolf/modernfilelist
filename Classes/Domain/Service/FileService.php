<?php
namespace AndreasWolf\Modernfilelist\Domain\Service;

use AndreasWolf\Modernfilelist\Domain\Repository\FileRepository;
use AndreasWolf\Modernfilelist\Serializer\FileArraySerializer;
use TYPO3\CMS\Core\Resource\File;


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

    public function getFilesArrayByPath($storage, $path)
    {
        $fileSerializer = new FileArraySerializer();

        $files = $this->fileRepository->getByPath($storage, $path);
        $referenceCounts = $this->getFileReferenceCounts($files);

        $files = array_map(function(File $file) use ($fileSerializer, $referenceCounts) {
            return array_merge($fileSerializer->serialize($file), [
                '_referenceCount' => $referenceCounts[$file->getUid()]
            ]);
        }, $files);

        return $files;
    }

    /**
     * @param File[] $files
     * @return \int[]
     */
    protected function getFileReferenceCounts($files)
    {
        $fileUids = array_map(function (File $file) {
            return $file->getUid();
        }, $files);

        $relationCounts = $this->fileRepository->countRelations($fileUids);

        return $relationCounts;
    }

}
