<?php

namespace Ecommistry\Blog\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class Products
 *
 * Long description for Class (if any)...
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class Products extends Template
{
    private $collection;
    
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }
    
    public function getLoadedProductCollection()
    {
        return $this->collection;
    }
    
    
}
