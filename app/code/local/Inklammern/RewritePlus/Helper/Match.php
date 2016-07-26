<?php

class Inklammern_RewritePlus_Helper_Match extends Mage_Core_Helper_Abstract
{

	private $requestUri;
	private $dbRead;
	private $matches = [];
	private $currentMatch;


	public function __construct()
	{
		$this->requestUri = Mage::app()->getRequest()->getOriginalRequest()->getRequestUri();
		$this->dbRead = Mage::getSingleton('core/resource')->getConnection('core_read');

		$this->loadMatches();
	}


	public function isMatch()
	{
		if (isset($this->matches[$this->requestUri])) return true;

		return false;
	}



	public function getMatchPage()
	{
		if (isset($this->matches[$this->requestUri]) && !$this->currentMatch)
		{
			$this->currentMatch = Mage::getModel('inklammern_rewriteplus/page')->load($this->matches[$this->requestUri]);
		}

		return $this->currentMatch;
	}


	private function loadMatches()
	{
		$collection = Mage::getResourceModel('inklammern_rewriteplus/page_collection')
			->addFieldToFilter('status', ['eq' => 1]);

		$select = $collection->getSelect()
			->reset(Zend_Db_Select::COLUMNS)
			->columns(['request_uri_match', 'id']);

		$this->matches = $this->dbRead->fetchPairs($select);
	}

}