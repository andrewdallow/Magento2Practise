<?php

namespace Ecommistry\Blog\Block;

use Magento\Framework\View\Element\Template;

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @category   Zend
 * @package    Zend_Ecommistry
 * @subpackage Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Blog extends Template
{
    protected $_blogFactory;
    
    public function _construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ecommistry\Blog\Model\BlogFactory $blogFactory
    ) {
        $this->_blogFactory = $blogFactory;
        parent::_construct($context);
    }
    
    public function _prepareLayout()
    {
        $blog = $this->_blogFactory->create();
        $collection = $blog->getCollection();
        foreach ($collection as $item) {
            var_dump($item->getData());
        }
        exit;
    }
}