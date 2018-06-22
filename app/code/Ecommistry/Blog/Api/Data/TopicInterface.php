<?php


namespace Ecommistry\Blog\Api\Data;

/**
 * Topic Interface
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
interface TopicInterface
{
    public const TOPIC_TITLE = 'title';
    public const TOPIC_DESCRIPTION = 'description';
    /**
     * @return int
     */
    public function getId();
    
    /**
     * @param int $id
     *
     * @return void
     */
    public function setId($id);
    
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
    public function getDescription();
    
    /**
     * @param string $description
     *
     * @return void
     */
    public function setDescription($description);
}
