<?php

namespace Ecommistry\Blog\Api\Data;

use Ecommistry\Blog\Api\Data\BlogExtensionInterface;
use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Blog API Interface
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface BlogInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();
    
    /**
     * @param int $value
     *
     * @return void
     */
    public function setId($value);
    
    /**
     * @return string
     */
    public function getTitle();
    
    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle($title);
    
    /**
     * @return string
     */
    public function getContent();
    
    /**
     * @param string $content
     *
     * @return void
     */
    public function setContent($content);
    
    /**
     * @return string
     */
    public function getCreationTime();
    
    /**
     * @return void
     */
    public function setCreationTime();
    
    /**
     * @return int
     */
    public function getTopicId();
    
    /**
     * @param int $id
     *
     * @return void
     */
    public function setTopicId($id);
    
    /**
     * @return string
     */
    public function getUpdatedTime();
    
    /**
     * @return void
     */
    public function setUpdatedTime();
    
    /**
     * @return \Ecommistry\Blog\Api\Data\BlogExtensionInterface
     */
    public function getExtensionAttributes();
    
    /**
     * @param \Ecommistry\Blog\Api\Data\BlogExtensionInterface $extension
     *
     * @return \Ecommistry\Blog\Api\Data\BlogInterface
     */
    public function setExtensionAttributes(BlogExtensionInterface $extension);
}