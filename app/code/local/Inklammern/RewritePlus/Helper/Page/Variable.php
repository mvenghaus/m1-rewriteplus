<?php

class Inklammern_RewritePlus_Helper_Page_Variable extends Mage_Core_Helper_Abstract
{
    private $pageService;

    public function __construct()
    {
        $this->pageService = Mage::getSingleton('inklammern_rewriteplus/service_page');
    }

    public function render($field, $default, $htmlContainer = '%s')
    {
        $content = $default;
        if ($this->pageService->hasCurrent())
        {
            $content = $this->pageService->getCurrent()->getData($field);
        }

        if ($content == '')
        {
            return '';
        }
        return sprintf($htmlContainer, $content);
    }

}