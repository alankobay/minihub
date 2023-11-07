<?php

namespace App\Jobs;

use App\Components\Platform\Gateways\ProductGateway;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductUpdateJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public string $productReference;
    public ProductRepository $productRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(string $productReference)
    {
        $this->productReference  = $productReference;
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $productPlatform = app(ProductGateway::class)->getProduct($this->productReference);

            if (blank($productPlatform)) {
                throw new Exception('Product data from platform is empty');
            }

            $product = $this->productRepository->findProductByReference($this->productReference);

            if (blank($product)) {
                throw new Exception('Product from HUB not found');
            }

            $this->productRepository->update($product->id, $productPlatform);
        } catch (Throwable $th) {
            Log::info('Product update failed', [
                'reference' => $this->productReference,
                'message'   => $th->getMessage(),
                'code'      => $th->getCode(),
            ]);

            throw $th;
        }
    }
}
