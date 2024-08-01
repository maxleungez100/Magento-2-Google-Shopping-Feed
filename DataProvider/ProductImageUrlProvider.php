<?php

declare(strict_types=1);

namespace RunAsRoot\GoogleShoppingFeed\DataProvider;

use Magento\Catalog\Model\Product\Image\UrlBuilder;
use Magento\Framework\Escaper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class ProductImageUrlProvider
{
    private Escaper $escaper;
    private UrlBuilder $imageUrlBuilder;
    protected $storeManager;

    public function __construct(
        Escaper $escaper,
        UrlBuilder $imageUrlBuilder,
        StoreManagerInterface $storeManager
    ) {
        $this->escaper = $escaper;
        $this->imageUrlBuilder = $imageUrlBuilder;
        $this->storeManager = $storeManager;
    }

    public function get(string $imagePath): string
    {
        $secureBaseUrl = $this->storeManager->getStore()->getBaseUrl(
            UrlInterface::URL_TYPE_MEDIA,
            true
        );
        $imageUrl = $this->imageUrlBuilder->getUrl($imagePath, 'product_page_image_large');
        if ($secureBaseUrl != "") {
            $position = strpos($imageUrl, "catalog");
            if ($position !== false) {
                $newUrl = substr($imageUrl, $position);
                $newUrl = $secureBaseUrl. $newUrl;
            }
        }


        return $this->escaper->escapeUrl($newUrl);
    }
}
