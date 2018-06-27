<?php

namespace Training\ExtAttribute\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Class CountrySearchResultInterface
 *
 * Long description for Class (if any)...
 *
 * @category   Training
 * @package    Training_ExtAttribute
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface CountrySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Training\ExtAttribute\Api\Data\CountryInterface[]
     */
    public function getItems();
    
    /**
     * @param \Training\ExtAttribute\Api\Data\CountryInterface[] $items
     *
     * @return void
     */
    public function setItems(array $items);
}
