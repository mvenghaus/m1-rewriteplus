<?php

class Inklammern_RewritePlus_Helper_Url extends Mage_Core_Helper_Abstract
{
	private $dbRead;
	private $mappings = [];

	public function __construct()
	{
		$this->dbRead = Mage::getSingleton('core/resource')->getConnection('core_read');

		$this->loadMappings();
	}


	public function getUrl($url)
	{
		$baseUrl = rtrim(Mage::getBaseUrl(), '/');

		$uri = str_replace(rtrim($baseUrl, '/'), '', $url);

		if (isset($this->mappings[$uri]))
		{
			return $baseUrl . $this->mappings[$uri];
		}

		return $url;
	}


	private function loadMappings()
	{
		$collection = Mage::getResourceModel('inklammern_rewriteplus/page_collection')
			->addFieldToFilter('status', ['eq' => 1]);

		$select = $collection->getSelect()
			->reset(Zend_Db_Select::COLUMNS)
			->columns(['request_uri_original', 'request_uri_match']);

		$this->mappings = $this->dbRead->fetchPairs($select);
	}

}