<?php

class Inklammern_RewritePlus_Block_Adminhtml_Group_Grid_Container extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'inklammern_rewriteplus';
        $this->_controller = 'adminhtml_group_grid_container';
        $this->_headerText = $this->__('Groups');
        $this->_addButtonLabel = $this->__('Add Group');
        parent::__construct();
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new');
    }

}

