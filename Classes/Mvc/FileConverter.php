<?php
namespace AndreasWolf\Modernfilelist\Mvc;

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter;


class FileConverter extends AbstractTypeConverter
{

    /**
     * @var array<string>
     */
    protected $sourceTypes = array('string');

    /**
     * @var string
     */
    protected $targetType = 'TYPO3\\CMS\\Core\\Resource\\AbstractFile';


    public function convertFrom(
        $source, $targetType, array $convertedChildProperties = array(),
        \TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface $configuration = null
    ) {
        /** @var ResourceFactory $resourceFactory */
        $resourceFactory = $this->objectManager->get('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');

        return $resourceFactory->getFileObjectFromCombinedIdentifier($source);
    }

}
