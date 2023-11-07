<?php

namespace App\Http\Controllers;

use App\Jobs\ProductUpdateJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    public function platform(Request $request): \Illuminate\Http\Response
    {
        $payload = $request->only([
            'product_ref',
            'scope',
        ]);

        Log::info('New Platform Notification', ['payload' => $payload]);

        // Diferenciação de escopos não foi requisito, mas pode ser implementado aqui
        ProductUpdateJob::dispatch($payload['product_ref']);

        return Response::noContent();
    }
}
