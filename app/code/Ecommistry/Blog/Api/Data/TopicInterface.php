<?php


namespace Ecommistry\Blog\Api\Data;

/**
 * Topic Interface
 *
 * @category   Zend
 * @package    Zend_${Package}
 * @subpackage ${Subpackage}
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface TopicInterface
{
    /**
     * @return mixed
     */
    public function getId();
    
    /**
     * @param mixed $id
     */
    public function setId($id);
    
    /**
     * @return mixed
     */
    public function getTitle();
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void;
    
    /**
     * @return null|string
     */
    public function getDescription(): ?string;
    
    /**
     * @param string $description
     */
    public function setDescription(string $description): void;
}