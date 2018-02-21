<?php
namespace Veriteworks\SortOrder\Plugin\Catalog\Model;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Config
 * @package Veriteworks\SortOrder\Plugin\Catalog\Model
 */
class Config {

    /**
     * Adding custom options and changing labels
     *
     * @param \Magento\Catalog\Model\Config $catalogConfig
     * @param [] $options
     * @return []
     */
    public function afterGetAttributeUsedForSortByArray(\Magento\Catalog\Model\Config $catalogConfig, $options)
    {
        //Remove specific default sorting options
        unset($options['position']);
        unset($options['name']);
        unset($options['price']);
        unset($options['size']);
        unset($options['color']);
        unset($options['color']);

        //New sorting options
        $customOption['created_at'] = __('New to Old');
        $customOption['low_to_high'] = __('Low to High');
        $customOption['high_to_low'] = __('High to Low');

        //Merge default sorting options with custom options
        $options = array_merge($customOption, $options);

        return $options;
    }
}
