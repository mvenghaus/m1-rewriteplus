<?php

class Inklammern_RewritePlus_Block_Adminhtml_Page_Grid_Container_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('inklammern_rewriteplus_pages');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('inklammern_rewriteplus/page')->getCollection();

        foreach($collection as $page)
        {
            $page->setStoreIds(explode(',', $page->getStoreIds()));
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('id', [
            'header' => $this->__('ID'),
            'width' => '50px',
            'index' => 'id'
        ]);

        $this->addColumn('status', [
            'header' => $this->__('Status'),
            'index' => 'status',
            'width' => '100px',
            'type' => 'options',
            'options' => [
                0 => $this->__('Disabled'),
                1 => $this->__('Enabled'),
            ]
        ]);

        $this->addColumn('group_id', [
            'header' => $this->__('Group'),
            'index' => 'group_id',
            'width' => '100px',
            'type' => 'options',
            'options' => Mage::getSingleton('inklammern_rewriteplus/service_group')->getSimpleArray()
        ]);

        if (!Mage::app()->isSingleStoreMode()) {

            $this->addColumn('store_ids', [
                'header'        => $this->__('Store View'),
                'index'         => 'store_ids',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => true,
                'filter_condition_callback' => [$this, '_filterStoreCondition'],
            ]);
        }

        $this->addColumn('title', [
            'header' => $this->__('Title'),
            'index' => 'title'
        ]);

        $this->addColumn('request_uri_match', [
            'header' => $this->__('Request Uri - Match'),
            'index' => 'request_uri_match'
        ]);

        $this->addColumn('request_uri_original', [
            'header' => $this->__('Request Uri - Original'),
            'index' => 'request_uri_original'
        ]);

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('inklammern_rewriteplus/page')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }


    protected function _filterStoreCondition($collection, $column){
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }

}
