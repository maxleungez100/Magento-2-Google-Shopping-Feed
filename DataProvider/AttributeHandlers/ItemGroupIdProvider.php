<?php

declare(strict_types=1);

namespace RunAsRoot\GoogleShoppingFeed\DataProvider\AttributeHandlers;

use Magento\Catalog\Model\Product;
use RunAsRoot\GoogleShoppingFeed\DataProvider\ParentProductProvider;

class ItemGroupIdProvider implements AttributeHandlerInterface
{
    private ParentProductProvider $parentProductProvider;

    public function __construct(ParentProductProvider $parentProductProvider)
    {
        $this->parentProductProvider = $parentProductProvider;
    }

    public function get(Product $product): string
    {
        return $this->parentProductProvider
            ->get($product)
            ->getSku();
    }
}
