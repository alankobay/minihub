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
 * @property float|null $sale_price
 * @property string|null $sale_starts_on
 * @property string|null $sale_ends_on
 * @property string|null $stock
 */
class Offer extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE   = 'active';
    public const STATUS_INACTIVE = 'paused';

    protected $table = 'offers';

    protected $fillable = [
        'reference',
        'title',
        'status',
        'price',
        'sale_price',
        'sale_starts_on',
        'sale_ends_on',
        'stock',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_offer', 'offer_id', 'product_id');
    }
}
