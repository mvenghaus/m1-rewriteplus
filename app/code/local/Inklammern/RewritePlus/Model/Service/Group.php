<?php

class Inklammern_RewritePlus_Model_Service_Group
{

    private $helper;

    public function __construct()
    {
        $this->helper = Mage::helper('inklammern_rewriteplus');
    }

    public function getSimpleArray($withEmpty = true)
    {
        $groupCollection = Mage::getResourceModel('inklammern_rewriteplus/group_collection');

        $groups = ['0' => $this->helper->__('No Group')];
        foreach ($groupCollection as $group)
        {
            $groups[$group->getId()] = $group->getName();
        }

        return $groups;
    }

}