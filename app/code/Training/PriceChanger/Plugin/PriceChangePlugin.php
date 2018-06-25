<?php

namespace Training\PriceChanger\Plugin;

use Magento\Catalog\Model\Product;
use Psr\Log\LoggerInterface;

/**
 * Class PriceChangePlugin
 *
 * Alter the product Price of all products.
 *
 * @category   Training
 * @package    Training_PriceChanger
 * @copyright  Copyright (c) 2018 ecommistry (http://www.ecommistry.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: 1.0
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0
 */
class PriceChangePlugin
{
    public const ALL_PRODUCT_DISCOUNT = 0.50;
    /** @var \Psr\Log\LoggerInterface */
    private $logger;
    
    /**
     * PriceChangePlugin constructor.
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }
    
    /**
     * @param \Magento\Catalog\Model\Product $product
     * @param callable                       $proceed
     *
     * @return float|int
     */
    public function aroundGetPrice(
        Product $product,
        callable $proceed
    ) {
        $originalPrice = $proceed();
        $newPrice = $originalPrice * (1 - self::ALL_PRODUCT_DISCOUNT);
        $this->logger->debug("Price Changed from $originalPrice to $newPrice");
        return $newPrice;
    }
    
}
