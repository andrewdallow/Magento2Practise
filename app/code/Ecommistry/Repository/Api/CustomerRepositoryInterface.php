<?php

namespace Ecommistry\Repository\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CustomerRepository
 *
 * Repository for Ecommistry Customer Model
 *
 * @category   Ecommistry
 * @package    Ecommistry_Repository
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface CustomerRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Ecommistry\Repository\Api\Data\CustomerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
