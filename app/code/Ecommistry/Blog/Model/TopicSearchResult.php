<?php

namespace Ecommistry\Blog\Model;

use Ecommistry\Blog\Api\Data\TopicSearchResultInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class TopicSearchResult
 *
 * Used to set the return types of funtions in interface.
 *
 * @category   Ecommistry
 * @package    Ecommistry_Blog
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class TopicSearchResult extends SearchResults implements
    TopicSearchResultInterface
{

}