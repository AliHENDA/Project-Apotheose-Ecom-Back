<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use App\Repository\Cart2Repository;

class PaymentController extends AbstractController
{

    /**
     * 
     * @Route ("/api/checkout", name="checkout") 
     */

    public function checkout(Request $request): Response
    {

        Stripe::setApiKey($_ENV['STRIPE_SECRET']);
        

        $content = $request->getContent();
        $data = json_decode($content, true);

        $session = Session::create([
            'line_items' => [[
                array_map(fn (array $product) => [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $product['name']
                        ],
                        'unit_amount' => $product['price']
                    ],
                    'quantity' => 1
                ], $data['products']),
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:5173/',
            'cancel_url' => 'http://localhost:5173/',
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['FR']
            ],
            'metadata' => [
                'cart_id' => $data['cart_id']
            ]
        ]);

        return $this->json(
            $session->url,
            // Le status code 200
            200,
            [],
            []
        );
    }

    /**
     * 
     * @Route ("/webhook", name="webhook") 
     */
    public function handle(Cart2Repository $cart2Repository)
    {
        Stripe::setApiKey($_ENV['STRIPE_SECRET']);

        $endpoint_secret = $_ENV['WH_SECRET'];

        $payload = file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        if ($event->type == 'checkout.session.completed') {
            // Retrieve the session. If you require line items in the response, you may include them by expanding line_items.
            $session = Session::retrieve([
              'id' => $event->data->object->id,
              'expand' => ['line_items'],
            ]);

            $cartId = $event->data->object->metadata->cart_id;
            $userId = $event->data->object->metadata->user_id;

            $cart2Repository->fulfillOrder($cartId, $userId);
            $line_items = $session->line_items;
            // Fulfill the purchase...
          }
        http_response_code(200);

        return $this->json(
            [],
            // Le status code 200
            200,
            [],
            []
        );
    }
}
