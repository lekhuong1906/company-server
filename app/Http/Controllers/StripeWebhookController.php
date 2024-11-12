<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request){
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('cashier.webhook.secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);

            // Xử lý các sự kiện Stripe
            if ($event->type === 'customer.created') {
                $customer = $event->data->object;
                // Thực hiện các thao tác cập nhật người dùng trong hệ thống của bạn
                Log::error("Customer created: " . $customer->id);
            }

            return new Response('Webhook handled', 200);
        } catch (\Exception $e) {
            Log::error('Stripe Webhook Error: ' . $e->getMessage());
            return new Response('Webhook error', 400);
        }
    }

    public function handleWebhookUpdateCustomer(Request $request){
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('cashier.webhook.secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);

            // Xử lý các sự kiện Stripe
            if ($event->type === 'customer.updated') {
                $customer = $event->data->object;
                // Thực hiện các thao tác cập nhật người dùng trong hệ thống của bạn
                Log::error("Customer updated: " . $customer->id);
            }

            return new Response('Webhook handled', 200);
        } catch (\Exception $e) {
            Log::error('Stripe Webhook Error: ' . $e->getMessage());
            return new Response('Webhook error', 400);
        }
    }

}
