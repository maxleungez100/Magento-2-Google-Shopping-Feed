<?php

declare(strict_types=1);

namespace RunAsRoot\GoogleShoppingFeed\DataProvider\AttributeHandlers;

use Magento\Catalog\Model\Product;
use Magento\Framework\Url;
use RunAsRoot\GoogleShoppingFeed\ConfigProvider\UrlSuffixProvider;
use RunAsRoot\GoogleShoppingFeed\DataProvider\ParentProductProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ProductUrlProvider implements AttributeHandlerInterface
{
    private Url $url;
    private ParentProductProvider $productProvider;
    private UrlSuffixProvider $urlSuffixProvider;
    protected $scopeConfig;

    public function __construct(
        Url $url,
        ParentProductProvider $productProvider,
        UrlSuffixProvider $urlSuffixProvider,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->url = $url;
        $this->productProvider = $productProvider;
        $this->urlSuffixProvider = $urlSuffixProvider;
        $this->scopeConfig = $scopeConfig;
    }

    public function get(Product $product): ?string
    {
        $productForUrlRetrieval = $this->productProvider->get($product);

        $prefix_url = $this->scopeConfig->getValue("run_as_root_product_feed/general/url_prefix");

        $url = sprintf(
            '%s%s%s',
            $prefix_url,
            'en/product/',
            $productForUrlRetrieval->getData('url_key'),

        );
        return $url;
    }
}
