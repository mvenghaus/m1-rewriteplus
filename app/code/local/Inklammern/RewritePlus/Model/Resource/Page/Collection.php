<?php
 
class Inklammern_RewritePlus_Model_Resource_Page_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('inklammern_rewriteplus/page');
    }

}