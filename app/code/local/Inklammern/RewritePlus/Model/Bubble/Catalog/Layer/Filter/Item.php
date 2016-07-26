<?php

class Inklammern_RewritePlus_Model_Bubble_Catalog_Layer_Filter_Item extends Bubble_Layer_Model_Catalog_Layer_Filter_Item
{

	public function getUrl()
	{
		return Mage::helper('inklammern_rewriteplus/url')->getUrl(parent::getUrl());
	}

}