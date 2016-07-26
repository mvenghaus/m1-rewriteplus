<?php

class Inklammern_RewritePlus_Block_Adminhtml_Page_Grid_Container_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

	protected function _getModel()
	{
		return Mage::registry('current_page');
	}

	protected function _getHelper()
	{
		return Mage::helper('inklammern_rewriteplus');
	}

	protected function _getModelTitle()
	{
		return 'Page';
	}

	protected function _prepareForm()
	{
		$model = $this->_getModel();

		$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig([
			'add_variables' => false,
			'add_widgets' => false,
			'add_images' => false
		]);

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

		// status
		$fieldset->addField('status', 'select', [
			'name' => 'status',
			'label' => $this->_getHelper()->__('Status'),
			'options' => [
				0 => $this->_getHelper()->__('Disabled'),
				1 => $this->_getHelper()->__('Enabled'),
			],
			'required' => true
		]);

        // store_id
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_ids', 'multiselect', array(
                'name' => 'store_ids[]',
                'label' => $this->_getHelper()->__('Store View'),
                'title' => $this->_getHelper()->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }
        else {
            $fieldset->addField('store_id', 'hidden', array(
                'name' => 'stores[]',
                'value' => Mage::app()->getStore(true)->getId()
            ));
        }

        // group_id
        $fieldset->addField('group_id', 'select', [
            'name' => 'group_id',
            'label' => $this->_getHelper()->__('Group'),
            'options' => Mage::getSingleton('inklammern_rewriteplus/service_group')->getSimpleArray(),
            'required' => true
        ]);

        // title
		$fieldset->addField('title', 'text', [
			'name' => 'title',
			'label' => $this->_getHelper()->__('Title'),
			'required' => true
		]);

        // request uri - match
		$fieldset->addField('request_uri_match', 'text', [
			'name' => 'request_uri_match',
			'label' => $this->_getHelper()->__('Request Uri - Match'),
			'required' => true
		]);

        // request uri - original
		$fieldset->addField('request_uri_original', 'text', [
			'name' => 'request_uri_original',
			'label' => $this->_getHelper()->__('Request Uri - Original'),
			'required' => true
		]);

        // description - top
		$fieldset->addField('description_top', 'editor', [
			'name' => 'description_top',
			'label' => $this->_getHelper()->__('Description Top'),
			'required' => false,
			'style' => 'height:15em',
			'config' => $wysiwygConfig,
			'wysiwyg' => true,
		]);

        // description - bottom
		$fieldset->addField('description_bottom', 'editor', [
			'name' => 'description_bottom',
			'label' => $this->_getHelper()->__('Description Bottom'),
			'required' => false,
			'style' => 'height:15em',
			'config' => $wysiwygConfig,
			'wysiwyg' => true,
		]);

        // meta title
		$fieldset->addField('meta_title', 'text', [
			'name' => 'meta_title',
			'label' => $this->_getHelper()->__('Meta Title'),
			'required' => false
		]);

        // meta description
		$fieldset->addField('meta_description', 'textarea', [
			'name' => 'meta_description',
			'label' => $this->_getHelper()->__('Meta Description'),
			'required' => false
		]);

        // meta keywords
		$fieldset->addField('meta_keywords', 'text', [
			'name' => 'meta_keywords',
			'label' => $this->_getHelper()->__('Meta Keywords'),
			'required' => false
		]);

        // meta robots
        $fieldset->addField('meta_robots', 'select', [
            'name' => 'meta_robots',
            'label' => $this->_getHelper()->__('Meta Robots'),
            'options' => [
                'INDEX, FOLLOW' => 'INDEX, FOLLOW',
                'NOINDEX, FOLLOW' => 'NOINDEX, FOLLOW',
                'INDEX, NOFOLLOW' => 'INDEX, NOFOLLOW',
                'NOINDEX, NOFOLLOW' => 'NOINDEX, NOFOLLOW',
            ],
            'required' => true
        ]);

        // meta canonical
        $fieldset->addField('meta_canonical', 'text', [
            'name' => 'meta_canonical',
            'label' => $this->_getHelper()->__('Meta Canonical'),
            'required' => false
        ]);


		if ($model)
		{
		    $model->setStoreIds(explode(',', $model->getStoreIds()));

			$form->setValues($model->getData());
		}
		$form->setUseContainer(true);
		$this->setForm($form);

		return parent::_prepareForm();
	}

}
