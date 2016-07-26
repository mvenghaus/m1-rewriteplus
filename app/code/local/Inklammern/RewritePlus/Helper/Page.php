<?php

class Inklammern_RewritePlus_Helper_Page extends Mage_Core_Helper_Abstract
{

    private $pageService;

    public function __construct()
    {
        $this->pageService = Mage::getSingleton('inklammern_rewriteplus/service_page');
    }


    public function hasCurrent()
    {
        return $this->pageService->hasCurrent();
    }


    public function getCurrent()
    {
        return $this->pageService->getCurrent();
    }

}