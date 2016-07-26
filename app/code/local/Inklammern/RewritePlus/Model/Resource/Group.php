<?php
 
class Inklammern_RewritePlus_Model_Resource_Group extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('inklammern_rewriteplus/groups', 'id');
    }

}
