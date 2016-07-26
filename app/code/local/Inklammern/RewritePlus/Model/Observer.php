<?php

class Inklammern_RewritePlus_Model_Observer
{

	private $matchHelper;

	public function __construct()
	{
		$this->matchHelper = Mage::helper('inklammern_rewriteplus/match');
	}


	public function controller_front_init_before(Varien_Event_Observer $observer)
	{

		if ($this->matchHelper->isMatch())
		{
			/** @var Mage_Core_Controller_Varien_Front $front */
			$front = $observer->getEvent()->getFront();

			$requestUriOriginal = $this->matchHelper->getMatchPage()->getRequestUriOriginal();

			$front->getRequest()->setRequestUri($requestUriOriginal);
		}

	}


	public function controller_action_layout_generate_blocks_after(Varien_Event_Observer $observer)
	{

		if ($this->matchHelper->isMatch())
		{
			$layout = Mage::app()->getLayout();
			$matchPage = $this->matchHelper->getMatchPage();

			// set metas
			if ($block = $layout->getBlock('head'))
			{
				/** @var Mage_Page_Block_Html_Head $block */
				$block
					->setTitle($matchPage->getMetaTitle())
					->setDescription($matchPage->getMetaDescription())
					->setKeywords($matchPage->getMetaKeywords());
			}

			// change breadcrumbs
			if ($block = $layout->getBlock('breadcrumbs'))
			{
				/** @var Mage_Page_Block_Html_Breadcrumbs $block */

				$class = new ReflectionClass(get_class($block));

				$property = $class->getProperty('_crumbs');
				$property->setAccessible(true);

				$currentCrumbs = $property->getValue($block);
				if (!$currentCrumbs) return;

				$crumbs = [current($currentCrumbs)];
				$crumbs[] = [
					'label' => $matchPage->getTitle(),
					'link' => '',
					'title' => '',
					'first' => '',
					'last' => '',
					'readonly' => '',
				];

				$property->setValue($block, $crumbs);

			}

		}

	}

}
