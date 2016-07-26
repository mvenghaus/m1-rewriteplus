<?php
 
class Inklammern_RewritePlus_Model_Resource_Page extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('inklammern_rewriteplus/pages', 'id');
    }

}
