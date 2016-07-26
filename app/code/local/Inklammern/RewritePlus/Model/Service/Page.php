<?php


class Inklammern_RewritePlus_Model_Service_Page
{

    private $current;
    private $pageProviderService;

    /**
     * Inklammern_RewritePlus_Model_Service_Page constructor.
     */
    public function __construct()
    {
        $this->request = Mage::app()->getRequest();
        $this->pageProviderService = Mage::getSingleton('inklammern_rewriteplus/service_page_provider');
    }


    public function hasCurrent()
    {
        try
        {
            $this->getCurrent();
        } catch (Exception $e)
        {
            return false;
        }

        return true;
    }


    public function getCurrent()
    {
        return $this->pageProviderService->loadByRequestUriMatch($this->request->getOriginalRequest()->getRequestUri());
    }

}


