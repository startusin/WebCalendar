<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    /**
     * Handle Stripe webhooks for subscription events.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request)
    {
        // You can handle specific webhook events here
        $payload = json_decode($request->getContent(), true);

        switch ($payload['type']) {
            case 'invoice.payment_succeeded':
                // Handle successful payment
                break;
            case 'invoice.payment_failed':
                // Handle failed payment
                break;
            // Add more cases for other events as needed
        }

        // Let Cashier handle the rest
        return parent::handleWebhook($request);
    }
}
