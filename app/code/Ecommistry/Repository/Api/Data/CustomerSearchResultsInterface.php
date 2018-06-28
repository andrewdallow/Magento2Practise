<?php

namespace Ecommistry\Repository\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface CustomerSearchResultsInterface
 *
 * Search Results for Ecommistry Customer Models
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface CustomerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Ecommistry\Repository\Api\Data\CustomerInterface[]
     */
    public function getItems();
    
    /**
     * @param array $items
     *
     * @return \Ecommistry\Repository\Api\Data\CustomerInterface
     */
    public function setItems(array $items);
}
