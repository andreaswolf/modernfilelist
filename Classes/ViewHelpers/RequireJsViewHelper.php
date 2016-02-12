<?php
namespace AndreasWolf\Modernfilelist\ViewHelpers;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;


class RequireJsViewHelper extends AbstractViewHelper
{

    public function render()
    {
        $pageRenderer = $this->getPageRenderer();
        $pageRenderer->loadRequireJs();
    }

    /**
     * @return PageRenderer
     */
    protected function getPageRenderer()
    {
        return $GLOBALS['TBE_TEMPLATE']->getPageRenderer();
    }

}
