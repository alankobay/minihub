<?php

namespace App\Components\Platform\Gateways;

use App\Components\Common\Client;
use App\Components\Platform\Entities\ProductPlatform;
use Exception;

class ProductGateway
{
    public const URL = 'https://demo8880419.mockable.io';

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client->getClient(self::URL);
    }

    /**
     * @throws Exception
     */
    public function getProduct(string $productRef): ProductPlatform|null
    {
        $response     = $this->client->get(self::URL . '/products/' . $productRef);
        $responseData = $response['data'] ?? null;

        if (blank($responseData)) {
            return null;
        }

        $productPlatform = new ProductPlatform();

        return $productPlatform->fromApi($responseData);
    }
}
