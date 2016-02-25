<?php
namespace AndreasWolf\Modernfilelist\Serializer;

use TYPO3\CMS\Core\Resource\File;


class FileArraySerializer
{

    public function serialize(File $file)
    {
        return [
            'name' => $file->getName(),
            // TODO this naming might be confusing as it differs from the FAL naming convention; decide if this
            // is ok for us.
            'path' => $file->getIdentifier(),
            'identifier' => $file->getCombinedIdentifier(),
            'type' => $file->getExtension(),
            'size' => $file->getSize(),
            'lastModified' => \DateTime::createFromFormat('U', $file->getModificationTime())
        ];
    }
}
