<?php

declare(strict_types=1);

namespace RunAsRoot\GoogleShoppingFeed\DataProvider\AttributeHandlers;

use Magento\Catalog\Model\Product;
use Magento\Framework\Url;
use RunAsRoot\GoogleShoppingFeed\ConfigProvider\UrlSuffixProvider;
use RunAsRoot\GoogleShoppingFeed\DataProvider\ParentProductProvider;

class ProductUrlProvider implements AttributeHandlerInterface
{
    private Url $url;
    private ParentProductProvider $productProvider;
    private UrlSuffixProvider $urlSuffixProvider;

    public function __construct(
        Url $url,
        ParentProductProvider $productProvider,
        UrlSuffixProvider $urlSuffixProvider
    ) {
        $this->url = $url;
        $this->productProvider = $productProvider;
        $this->urlSuffixProvider = $urlSuffixProvider;
    }

    public function get(Product $product): ?string
    {
        $productForUrlRetrieval = $this->productProvider->get($product);

        $url = sprintf(
            '%s%s',
            'en/product/',
            $productForUrlRetrieval->getData('url_key'),
            
        );

        $routeParamsShort = [
            '_direct' => $url,
            '_nosid' => true,
        ];

        return $this->url->getUrl('', $routeParamsShort);
    }
}
