<?php

class Inklammern_RewritePlus_Block_Adminhtml_Page_Grid_Container extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'inklammern_rewriteplus';
        $this->_controller = 'adminhtml_page_grid_container';
        $this->_headerText = $this->__('Pages');
        $this->_addButtonLabel = $this->__('Add Page');
        parent::__construct();
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new');
    }

}

