<?php

namespace App\Components\Platform\Entities;

use App\Components\Common\Entities\ToArray;
use App\Components\Marketplace\Entities\OfferMarketplace;

class ProductPlatform
{
    use ToArray;

    public const STATUS_ACTIVE   = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public string $reference;
    public string $title;
    public string $status;
    public float $price;
    public float|null $promotional_price;
    public string|null $promotion_starts_on;
    public string|null $promotion_ends_on;
    public int $quantity;

    public function fromApi(array $data): self
    {
        $this->reference           = $data['reference'];
        $this->title               = $data['title'];
        $this->status              = $data['status'];
        $this->price               = $data['price'];
        $this->promotional_price   = $data['promotional_price']   ?? null;
        $this->promotion_starts_on = $data['promotion_starts_on'] ?? null;
        $this->promotion_ends_on   = $data['promotion_ends_on']   ?? null;
        $this->quantity            = $data['quantity'];

        return $this;
    }
}
