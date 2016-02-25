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

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_DELETE = 'DELETE';

    protected $allowedActions = [
        'getFiles' => ['method' => self::METHOD_GET],
        'deleteFile' => ['method' => self::METHOD_DELETE]

    ];

    public function __construct()
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    }

    public function getFiles()
    {
        $this->callActionAndSendResponse('getFiles');
    }

    public function deleteFile()
    {
        $this->callActionAndSendResponse('deleteFile');
    }

    /**
     * @param string $action The action in AjaxController that should be called.
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InfiniteLoopException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidActionNameException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidControllerNameException
     */
    protected function callActionAndSendResponse($action)
    {
        // TODO verify the method is correct

        // initialize a request based on what we got via the AJAX dispatcher and let Extbase handle the dirty stuff
        $request = new Request();
        $request->setControllerVendorName('AndreasWolf');
        $request->setControllerExtensionName('modernfilelist');
        $request->setControllerName('Ajax');
        $request->setControllerActionName($action);
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
