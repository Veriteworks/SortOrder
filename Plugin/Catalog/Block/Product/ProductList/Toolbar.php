<?php
/**
 * Created by PhpStorm.
 * User: tsuchiya
 * Date: 2018/01/30
 * Time: 9:41
 */
namespace Veriteworks\SortOrder\Plugin\Catalog\Block\Product\ProductList;

/**
 * Class Toolbar
 * @package Veriteworks\SortOrder\Plugin\Catalog\Block\Product\ProductList
 */
class Toolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar
{

    /**
     * @param \Magento\Catalog\Block\Product\ProductList\Toolbar $subject
     * @param \Closure $proceed
     * @param $collection
     * @return mixed
     */
    public function aroundSetCollection(\Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
                                        \Closure $proceed,
                                        $collection)
    {
        $currentOrder = $subject->getCurrentOrder();
        $result = $proceed($collection);

        if ($currentOrder) {
            if ($currentOrder == 'created_at') {
                $subject->getCollection()->setOrder('created_at', 'desc');
            } elseif ($currentOrder == 'high_to_low') {
                $subject->getCollection()->setOrder('price', 'desc');
            } elseif ($currentOrder == 'low_to_high') {
                $subject->getCollection()->setOrder('price', 'asc');
            }
        }

        return $result;
    }
}