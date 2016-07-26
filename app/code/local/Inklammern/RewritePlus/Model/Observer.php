<?php

class Inklammern_RewritePlus_Model_Observer
{

    private $pageService;

    public function __construct()
	{
		$this->pageService = Mage::getSingleton('inklammern_rewriteplus/service_page');
	}


	public function controller_front_init_before(Varien_Event_Observer $observer)
	{

		if ($this->pageService->hasCurrent())
		{
			/** @var Mage_Core_Controller_Varien_Front $front */
            $observer->getEvent()->getFront()->getRequest()->setRequestUri($this->pageService->getCurrent()->getRequestUriOriginal());
		}

	}


	public function controller_action_layout_generate_blocks_after(Varien_Event_Observer $observer)
	{

		if ($this->pageService->hasCurrent())
		{
			$layout = Mage::app()->getLayout();
			$page = $this->pageService->getCurrent();

			// set metas
			if ($block = $layout->getBlock('head'))
			{
				/** @var Mage_Page_Block_Html_Head $block */
				$block
					->setTitle($page->getMetaTitle())
					->setDescription($page->getMetaDescription())
					->setKeywords($page->getMetaKeywords())
					->setRobots($page->getMetaRobots());
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
					'label' => $page->getTitle(),
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
