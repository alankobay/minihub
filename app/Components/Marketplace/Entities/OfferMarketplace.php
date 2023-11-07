<?php

namespace App\Components\Marketplace\Entities;

use App\Components\Common\Entities\ToArray;
use App\Components\Platform\Entities\ProductPlatform;
use Exception;

class OfferMarketplace
{
    use ToArray;

    public const STATUS_ACTIVE   = 'active';
    public const STATUS_INACTIVE = 'paused';
    public string|null $reference;
    public string $title;
    public string $status;
    public float $price;
    public float|null $sale_price;
    public string|null $sale_starts_on;
    public string|null $sale_ends_on;
    public int $stock;

    /**
     * @throws Exception
     */
    public function parseProductStatus(string $status): string
    {
        return match ($status) {
            ProductPlatform::STATUS_ACTIVE   => self::STATUS_ACTIVE,
            ProductPlatform::STATUS_INACTIVE => self::STATUS_INACTIVE,
            default                          => throw new Exception('Invalid product platform status'),
        };
    }
}
