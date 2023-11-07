<?php

namespace App\Repositories;

use App\Components\Marketplace\Entities\OfferMarketplace;
use App\Events\OfferUpdated;
use App\Models\Offer;
use Illuminate\Support\Facades\Log;

class OfferRepository
{
    public function find(int $id): Offer
    {
        return Offer::findOrFail($id);
    }
    public function updateByProductRelation(int $productId, OfferMarketplace $offerMarketplace): void
    {
        $offers = Offer::whereHas('products', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->get();

        $offers->each(function ($offer) use ($productId, $offerMarketplace) {
            $offer->update($offerMarketplace->toArrayOnly([
                'title',
                'status',
                'price',
                'sale_price',
                'sale_starts_on',
                'sale_ends_on',
                'stock',
            ]));

            // @TODO Adicionar validação se houve alteração no registro

            Log::info('Offer updated successfully', [
                'id'        => $offer->id,
                'reference' => $offer->reference,
                'product'   => $productId,
            ]);

            event(new OfferUpdated($offer->id));
        });
    }
}
