<?php

class Inklammern_RewritePlus_Model_Service_Page_Provider
{
    private $dbRead;
    private $requestUriMatchMapping;


    public function __construct()
    {
        $this->coreResource = Mage::getSingleton('core/resource');
        $this->dbRead = $this->coreResource->getConnection('core_read');
    }


    public function loadByRequestUriMatch($requestUriMatch)
    {
        $this->loadRequestUriMatchMapping();

        $pageId = (isset($this->requestUriMatchMapping[$requestUriMatch]) ? $this->requestUriMatchMapping[$requestUriMatch] : 0);

        if ($pageId > 0)
        {
            return Mage::getModel('inklammern_rewriteplus/page')->load($pageId);
        }

        throw new Exception(sprintf('no page found for request_uri_match "%s"', $requestUriMatch));
    }


    private function loadRequestUriMatchMapping()
    {
        if ($this->requestUriMatchMapping === null)
        {
            $select = $this->dbRead->select()
                ->from($this->coreResource->getTableName('inklammern_rewriteplus/pages'), ['request_uri_match', 'id'])
                ->where('status=1');

            $this->requestUriMatchMapping = $this->dbRead->fetchPairs($select);
        }
    }

}