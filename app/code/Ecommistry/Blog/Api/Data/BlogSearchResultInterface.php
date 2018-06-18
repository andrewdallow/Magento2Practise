<?php

namespace Ecommistry\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Class BlogSearchResultInterface
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
interface BlogSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Ecommistry\Blog\Api\Data\BlogInterface[]
     */
    public function getItems();
    
    /**
     * @param \Ecommistry\Blog\Api\Data\BlogInterface[] $items
     *
     * @return void
     */
    public function setItems(array $items);
}
