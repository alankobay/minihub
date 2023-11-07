<?php

namespace App\Repositories;

use App\Components\Platform\Entities\ProductPlatform;
use App\Events\ProductUpdated;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    public function find(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function findProductByReference(string $productReference): Product|null
    {
        return Product::where('reference', $productReference)->first();
    }

    public function update(int $id, ProductPlatform $productPlatform): Product
    {
        $product = Product::findOrFail($id);
        $product->update($productPlatform->toArray());

        // @TODO Adicionar validação se houve alteração no registro

        Log::info('Product updated successfully', [
            'id'        => $product->id,
            'reference' => $product->reference,
        ]);

        event(new ProductUpdated($product->id));

        return $product->fresh();
    }
}
