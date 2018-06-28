<?php

namespace Ecommistry\Repository\Model;

use Ecommistry\Repository\Api\Data\CustomerSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class CustomerSearchResults
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class CustomerSearchResults extends SearchResults implements
    CustomerSearchResultsInterface
{
    
}
