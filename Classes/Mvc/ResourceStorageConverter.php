<?php
namespace AndreasWolf\Modernfilelist\Mvc;

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter;


/**
 *
 */
class ResourceStorageConverter extends AbstractTypeConverter
{

    /**
     * @var array<string>
     */
    protected $sourceTypes = array('string', 'integer');

    /**
     * @var string
     */
    protected $targetType = 'TYPO3\\CMS\\Core\\Resource\\ResourceStorage';


    public function convertFrom(
        $source,
        $targetType,
        array $convertedChildProperties = array(),
        \TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface $configuration = null
    ) {
        /** @var ResourceFactory $resourceFactory */
        $resourceFactory = $this->objectManager->get('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');

        // make sure we use storage 1 by default
        $storageId = max(1, (int)$source);
        return $resourceFactory->getStorageObject($storageId);
    }

}
