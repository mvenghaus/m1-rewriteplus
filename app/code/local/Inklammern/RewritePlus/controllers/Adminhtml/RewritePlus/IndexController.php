<?php

class Inklammern_RewritePlus_Adminhtml_RewritePlus_IndexController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();

        $this->_addContent($this->getLayout()->createBlock('inklammern_rewriteplus/adminhtml_page_grid_container'));

        $this->renderLayout();
    }


    public function newAction()
    {
        $this->loadLayout();

        $this->_addContent($this->getLayout()->createBlock('inklammern_rewriteplus/adminhtml_page_grid_container_edit'));

        $this->renderLayout();
    }


    public function editAction()
    {
        $page = Mage::getModel('inklammern_rewriteplus/page')->load($this->getRequest()->getParam('id'));

        Mage::register('current_page', $page);

        $this->loadLayout();

        $this->_addContent($this->getLayout()->createBlock('inklammern_rewriteplus/adminhtml_page_grid_container_edit'));

        $this->renderLayout();
    }


    public function saveAction()
    {
        $params = [];
        $postData = $this->getRequest()->getPost();

        if (count($postData) > 0)
        {
            if (in_array(0, $postData['store_ids']))
            {
                $postData['store_ids'] = 0;
            } else {
                $postData['store_ids'] = implode(',', $postData['store_ids']);
            }

            $page = Mage::getModel('inklammern_rewriteplus/page')
                ->setData($postData)
                ->save();

            $params['id'] = $page->getId();

            $this->_getSession()->addSuccess($this->_getHelper()->__('Page successfully saved.'));
        }

        $this->_redirect('*/*/' . $this->getRequest()->getParam('back', 'index'), $params);
    }


    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');

        Mage::getModel('inklammern_rewriteplus/page')->load($id)->delete();

        $this->_getSession()->addSuccess($this->_getHelper()->__('Page(s) successfully deleted.'));

        $this->_redirect('*/*/index');
    }


    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');

        foreach ($ids as $id)
        {
            Mage::getModel('inklammern_rewriteplus/item')->load($id)->delete();
        }

        $this->_getSession()->addSuccess($this->_getHelper()->__('Page(s) successfully deleted.'));

        $this->_redirectReferer();
    }


    protected function _getHelper()
    {
        return Mage::helper('inklammern_rewriteplus');
    }


    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/inklammern_rewriteplus');
    }


}
