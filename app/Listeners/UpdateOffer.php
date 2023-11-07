<?php

namespace App\Listeners;

use App\Components\Marketplace\Entities\OfferMarketplace;
use App\Events\ProductUpdated;
use App\Repositories\OfferRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UpdateOffer implements ShouldQueue
{
    // Comentado para facilitar a execução do job na fila default
    // public string $queue = 'listeners';
    public OfferRepository $offerRepository;
    public ProductRepository $productRepository;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->offerRepository   = app(OfferRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * Handle the event.
     */
    public function handle(ProductUpdated $event): void
    {
        $productId = $event->productId;

        try {
            $product = $this->productRepository->find($productId);

            if (blank($product)) {
                throw new Exception('Product from HUB not found');
            }

            $offerMarketplace                 = new OfferMarketplace();
            $offerMarketplace->title          = $product->title;
            $offerMarketplace->status         = $offerMarketplace->parseProductStatus($product->status);
            $offerMarketplace->price          = $product->price;
            $offerMarketplace->sale_price     = $product->promotional_price;
            $offerMarketplace->sale_starts_on = $product->promotion_starts_on;
            $offerMarketplace->sale_ends_on   = $product->promotion_ends_on;
            $offerMarketplace->stock          = $product->quantity;

            $this->offerRepository->updateByProductRelation($productId, $offerMarketplace);

            Log::info('Offer update listener processed successfully', [
                'product' => $productId,
            ]);
        } catch (\Throwable $th) {
            Log::info('Offer update listener failed', [
                'product' => $productId,
                'message'   => $th->getMessage(),
                'code'      => $th->getCode(),
            ]);

            throw $th;
        }
    }
}
