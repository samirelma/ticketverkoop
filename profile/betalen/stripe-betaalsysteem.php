<?php
require_once('../vendor/autoload.php');

$stripe = new \Stripe\StripeClient("sk_test_51P5jTQP2GZCPF4IhCajCxEdG4n631bpAoBp6QJmaOk9Ckc5Jye2Y88hpCpX2GAc24ZHphKNglvbIRGigukHg7yby001MGIOcHu");

$product = $stripe->products->create([
  'name' => 'Starter pack',
  'description' => 'Premium starter pack',
]);
echo "Success! Here is your starter pack product id: " . $product->id . "\n";

$price = $stripe->prices->create([
  'unit_amount' => 8000,
  'currency' => 'eur',
  'product' => $product['id'],
]);
echo "Success! Here is your starter pack price id: " . $price->id . "\n";

$session = $stripe->checkout->sessions->create([
  'payment_method_types' => ['card'],
  'line_items' => [
    [
      'price' => $price->id,
      'quantity' => 1,
    ],
  ],
  'mode' => 'payment',
  'success_url' => 'https://example.com/success',
  'cancel_url' => 'https://example.com/cancel',
]);

?>