<?php

namespace App\Listeners;

use App\Components\Marketplace\Gateways\OfferGateway;
use App\Events\OfferUpdated;
use App\Repositories\OfferRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class NotifyMarketplace implements ShouldQueue
{
    // Comentado para facilitar a execução do job na fila default
    // public string $queue = 'listeners';

    public OfferRepository $offerRepository;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->offerRepository = app(OfferRepository::class);
    }

    /**
     * Handle the event.
     */
    public function handle(OfferUpdated $event): void
    {
        $offerId = $event->offerId;
        try {
            $offer = $this->offerRepository->find($offerId);

            $marketplaceResponse = app(OfferGateway::class)->notifyWebhook($offer->reference);

            Log::info('Marketplace notify listener processed successfully', [
                'offer'    => $offerId,
                'response' => $marketplaceResponse,
            ]);
        } catch (\Throwable $th) {
            Log::info('Marketplace notify listener failed', [
                'offer'   => $offerId,
                'message' => $th->getMessage(),
                'code'    => $th->getCode(),
            ]);

            throw $th;
        }
    }
}
