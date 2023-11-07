<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
* @property int $id
* @property string $reference
* @property string $title
* @property string $status
* @property float $price
* @property float|null $promotional_price
* @property string|null $promotion_starts_on
* @property string|null $promotion_ends_on
* @property string|null $quantity
 */
class Product extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE   = 'active';
    public const STATUS_INACTIVE = 'inactive';

    protected $table = 'products';

    protected $fillable = [
        'reference',
        'title',
        'status',
        'price',
        'promotional_price',
        'promotion_starts_on',
        'promotion_ends_on',
        'quantity',
    ];

    public function offers(): BelongsToMany
    {
        return $this->belongsToMany(Offer::class, 'product_offer', 'product_id', 'offer_id');
    }
}
