<?php
namespace AndreasWolf\Modernfilelist\Ajax;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Core\Bootstrap;
use TYPO3\CMS\Extbase\Mvc\Dispatcher;
use TYPO3\CMS\Extbase\Mvc\Web\Request;
use TYPO3\CMS\Extbase\Mvc\Web\RequestBuilder;
use TYPO3\CMS\Extbase\Mvc\Web\Response;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;


class FileListEndpoint
{

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    public function __construct()
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    }


    public function getFiles()
    {
        /** @var Bootstrap $bootstrap */
        $bootstrap = $this->objectManager->get(Bootstrap::class);
        $bootstrap->initialize([
            'extensionName' => 'modernfilelist',
            'pluginName' => 'file_ModernfilelistModernlist',
            'tx_modernfilelist_file_modernfilelistmodernlist' => [
                'controller' => 'FileList'
            ]
        ]);
        /** @var RequestBuilder $requestBuilder */
        $requestBuilder = $this->objectManager->get(RequestBuilder::class);
        $request = new Request();
        $request->setControllerVendorName('AndreasWolf');
        $request->setControllerExtensionName('modernfilelist');
        $request->setControllerName('Ajax');
        $request->setControllerActionName('getFiles');
        $request->setFormat('json');
        $request->setArguments(GeneralUtility::_GP('tx_modernfilelist'));

        /** @var Response $response */
        $response = $this->objectManager->get(Response::class);

        /** @var Dispatcher $dispatcher */
        $dispatcher = $this->objectManager->get(Dispatcher::class);
        $dispatcher->dispatch($request, $response);
        $response->send();
    }

}
