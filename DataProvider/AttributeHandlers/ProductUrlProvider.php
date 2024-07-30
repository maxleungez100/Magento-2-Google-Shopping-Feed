<?php

declare(strict_types=1);

namespace RunAsRoot\GoogleShoppingFeed\DataProvider\AttributeHandlers;

use Magento\Catalog\Model\Product;
use RunAsRoot\GoogleShoppingFeed\DataProvider\ParentProductProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

class ProductUrlProvider implements AttributeHandlerInterface
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
        $productForUrlRetrieval = $this->productProvider->get($product);

        $prefix_url = $this->scopeConfig->getValue("run_as_root_product_feed/general/url_prefix");

        $store = $this->storeManager->getStore($product->getStoreId());

        $lng = $store->getCode() == "default" ? "en" : "zh";

        $url = sprintf(
            '%s/%s/%s/%s',
            $prefix_url,
            $lng,
            'product',
            $productForUrlRetrieval->getData('url_key'),

        );
        return $url;
    }
}
