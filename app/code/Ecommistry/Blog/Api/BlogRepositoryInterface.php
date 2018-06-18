<?php

namespace Ecommistry\Blog\Api;

use Ecommistry\Blog\Api\Data\BlogInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class BlogRepositoryInterface
 *
 * Blog Repository Interface for CRUD operations.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface BlogRepositoryInterface
{
    /**
     * @param \Ecommistry\Blog\Api\Data\BlogInterface $blog
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(BlogInterface $blog);
    
    /**
     * @param int $id
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id);
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Ecommistry\Blog\Api\Data\BlogSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria
    );
    
    /**
     * @param \Ecommistry\Blog\Api\Data\BlogInterface $blog
     *
     * @return void
     */
    public function delete(BlogInterface $blog);
    
    /**
     * @param int $id
     *
     * @return void
     */
    public function deleteById(int $id);
}
