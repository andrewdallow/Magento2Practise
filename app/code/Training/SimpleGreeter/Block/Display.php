<?php

namespace Training\SimpleGreeter\Block;

use Magento\Framework\View\Element\Template;

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @category   Zend
 * @package    Zend_Training
 * @subpackage SimpleGreeter
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Display extends Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
    
    public function hello()
    {
        return __('Hello World');
    }
}