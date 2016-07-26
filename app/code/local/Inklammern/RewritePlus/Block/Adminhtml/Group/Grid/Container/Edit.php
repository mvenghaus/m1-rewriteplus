<?php

class Inklammern_RewritePlus_Block_Adminhtml_Group_Grid_Container_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

	public function __construct()
	{
		// $this->_objectId = 'id';
		parent::__construct();
		$this->_blockGroup = 'inklammern_rewriteplus';
		$this->_controller = 'adminhtml_group_grid_container';
		$this->_mode = 'edit';

		$this->_updateButton('save', 'label', $this->_getHelper()->__('Save'));
		$this->_addButton('saveandcontinue', array(
			'label' => $this->_getHelper()->__('Save and Continue Edit'),
			'onclick' => 'saveAndContinueEdit()',
			'class' => 'save',
		), -100);

		$this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
	}

    protected function _getHelper()
	{
		return Mage::helper('inklammern_rewriteplus');
	}

	protected function _getModel()
	{
		return Mage::registry('current_group');
	}

	protected function _getModelTitle()
	{
		return 'Page';
	}

	public function getHeaderText()
	{
		$model = $this->_getModel();
		if ($model && $model->getId())
		{
			return $this->_getHelper()->__("Edit Group (ID: %d)", $model->getId());
		} else
		{
			return $this->_getHelper()->__("New Group");
		}
	}


	/**
	 * Get URL for back (reset) button
	 *
	 * @return string
	 */
	public function getBackUrl()
	{
		return $this->getUrl('*/*/index');
	}

	public function getDeleteUrl()
	{
		return $this->getUrl('*/*/delete', array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
	}

	/**
	 * Get form save URL
	 *
	 * @deprecated
	 * @see getFormActionUrl()
	 * @return string
	 */
	public function getSaveUrl()
	{
		$this->setData('form_action_url', 'save');
		return $this->getFormActionUrl();
	}


}
