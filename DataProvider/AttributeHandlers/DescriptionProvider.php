<?php

declare(strict_types=1);

namespace RunAsRoot\GoogleShoppingFeed\DataProvider\AttributeHandlers;

use Magento\Catalog\Model\Product;
use RunAsRoot\GoogleShoppingFeed\DataProvider\ParentProductProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

class DescriptionProvider implements AttributeHandlerInterface
{
    private ParentProductProvider $productProvider;
    protected $scopeConfig;
    protected $storeManager;

    public function __construct(
        ParentProductProvider $productProvider,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManagerInterface
    ) {

        $this->productProvider = $productProvider;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManagerInterface;
    }

    public function get(Product $product): ?string
    {
        $description = $product->getDescription();

        if (isset($description)) {
            $description = strip_tags($description);
        }else{
            $description = "";
        }

        return $description;
    }
}
