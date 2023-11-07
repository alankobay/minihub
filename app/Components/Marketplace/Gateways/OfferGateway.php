<?php

namespace App\Components\Marketplace\Gateways;

use App\Components\Common\Client;
use Exception;

class OfferGateway
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
    public function notifyWebhook(string $offerRef): array|null
    {
        $response = $this->client->post(self::URL . '/webhook', [
            'offer_ref' => $offerRef,
        ]);

        if (blank($response)) {
            return null;
        }

        return $response;
    }
}
