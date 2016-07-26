<?php

class Inklammern_RewritePlus_Block_Adminhtml_Group_Grid_Container_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

	protected function _getModel()
	{
		return Mage::registry('current_group');
	}

	protected function _getHelper()
	{
		return Mage::helper('inklammern_rewriteplus');
	}

	protected function _getModelTitle()
	{
		return 'Group';
	}

	protected function _prepareForm()
	{
		$model = $this->_getModel();

		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save'),
			'method' => 'post'
		));

		$fieldset = $form->addFieldset('base_fieldset', array(
			'legend' => $this->_getHelper()->__('General'),
			'class' => 'fieldset-wide',
		));

		if ($model && $model->getId())
		{
			$modelPk = $model->getResource()->getIdFieldName();
			$fieldset->addField($modelPk, 'hidden', array(
				'name' => $modelPk,
			));
		}

        // name
		$fieldset->addField('name', 'text', [
			'name' => 'name',
			'label' => $this->_getHelper()->__('Name'),
			'required' => true
		]);

		if ($model)
		{
			$form->setValues($model->getData());
		}
		$form->setUseContainer(true);
		$this->setForm($form);

		return parent::_prepareForm();
	}

}
