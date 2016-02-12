<?php
namespace AndreasWolf\Modernfilelist\Serializer;

use TYPO3\CMS\Core\Resource\File;


class FileArraySerializer
{

    public function serialize(File $file)
    {
        return [
            'name' => $file->getName(),
        ];
    }
}
