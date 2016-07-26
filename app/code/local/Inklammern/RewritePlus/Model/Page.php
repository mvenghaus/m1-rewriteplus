<?php
 
class Inklammern_RewritePlus_Model_Page extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('inklammern_rewriteplus/page');
    }


	public function loadByRequestUriMatch($requestUriMatch)
	{
		return $this->load($requestUriMatch, 'request_uri_match');
	}

}
