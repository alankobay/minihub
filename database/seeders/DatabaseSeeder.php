<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->seedProducts();
        $this->seedOffers();
        $this->seedPivots();
    }

    private function seedProducts(): void
    {
        $products = [
            [
                'reference'           => '20231001',
                'title'               => 'Camiseta regata',
                'status'              => 'active',
                'price'               => 29.90,
                'promotional_price'   => 19.90,
                'promotion_starts_on' => '2023-01-01 00:00:00',
                'promotion_ends_on'   => '2023-12-31 23:59:59',
                'quantity'            => 10,
            ],
            [
                'reference'           => '20231002',
                'title'               => 'Cropped de renda',
                'status'              => 'active',
                'price'               => 29.90,
                'promotional_price'   => null,
                'promotion_starts_on' => null,
                'promotion_ends_on'   => null,
                'quantity'            => 12,
            ],
            [
                'reference'           => '20231003',
                'title'               => 'Calça jeans',
                'status'              => 'inactive',
                'price'               => 299.99,
                'promotional_price'   => 249.90,
                'promotion_starts_on' => '2023-01-01 00:00:00',
                'promotion_ends_on'   => '2023-12-31 23:59:59',
                'quantity'            => 5,
            ],
            [
                'reference'           => '20231004',
                'title'               => 'Bermuda cargo',
                'status'              => 'inactive',
                'price'               => 39.99,
                'promotional_price'   => null,
                'promotion_starts_on' => null,
                'promotion_ends_on'   => null,
                'quantity'            => 10,
            ]
        ];

        foreach ($products as $product) {
            if (Product::where('reference', $product['reference'])->exists()) {
                continue;
            }
            Product::factory()->create($product);
        }
    }

    private function seedOffers(): void
    {
        $offers = [
            [
                'reference'      => 'cra-001',
                'title'          => 'Camiseta regata 100% algodão',
                'status'         => 'active',
                'price'          => 29.90,
                'sale_price'     => 19.90,
                'sale_starts_on' => '2023-01-01 00:00:00',
                'sale_ends_on'   => '2023-12-31 23:59:59',
                'stock'          => 10,
            ],
            [
                'reference'      => 'crvc-001',
                'title'          => 'Camiseta regata várias cores',
                'status'         => 'active',
                'price'          => 29.90,
                'sale_price'     => 19.90,
                'sale_starts_on' => '2023-01-01 00:00:00',
                'sale_ends_on'   => '2023-12-31 23:59:59',
                'stock'          => 10,
            ],
            [
                'reference'      => 'cdrtu-001',
                'title'          => 'Cropped de renda tamanho único',
                'status'         => 'active',
                'price'          => 29.90,
                'sale_price'     => null,
                'sale_starts_on' => null,
                'sale_ends_on'   => null,
                'stock'          => 12,
            ],
            [
                'reference'      => 'cjtu-001',
                'title'          => 'Calça jeans tamanho único',
                'status'         => 'paused',
                'price'          => 299.99,
                'sale_price'     => 249.90,
                'sale_starts_on' => '2023-01-01 00:00:00',
                'sale_ends_on'   => '2023-12-31 23:59:59',
                'stock'          => 5,
            ],
            [
                'reference'      => 'bjtu-001',
                'title'          => 'Bermuda jeans tamanho único',
                'status'         => 'paused',
                'price'          => 59.90,
                'sale_price'     => null,
                'sale_starts_on' => null,
                'sale_ends_on'   => null,
                'stock'          => 0,
            ]
        ];

        foreach ($offers as $offer) {
            if (Offer::where('reference', $offer['reference'])->exists()) {
                continue;
            }
            Offer::factory()->create($offer);
        }
    }

    private function seedPivots(): void
    {
        $pivots = [
            [
                'product_id' => 1,
                'offer_id'   => 1,
            ],
            [
                'product_id' => 1,
                'offer_id'   => 2,
            ],
            [
                'product_id' => 2,
                'offer_id'   => 3,
            ],
            [
                'product_id' => 3,
                'offer_id'   => 4,
            ]
        ];

        foreach ($pivots as $pivot) {
            Product::find($pivot['product_id'])->offers()->syncWithoutDetaching($pivot['offer_id']);
        }
    }
}
