<?php

include $_SERVER['DOCUMENT_ROOT'] . "/connect/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/connect/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/fetch/util.php";
include $_SERVER['DOCUMENT_ROOT'] . "/functions/userfunctions.php";
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

session_start();


$purchaseID = $_GET['purchaseid'] ?? null;

if (strpos($purchaseID, ',') !== false) {
  $purchaseID = explode(',', $purchaseID)[0];
}

if ($purchaseID == null) {
// header("Location: /");
}


$stripe = new \Stripe\StripeClient("sk_test_51P5jTQP2GZCPF4IhCajCxEdG4n631bpAoBp6QJmaOk9Ckc5Jye2Y88hpCpX2GAc24ZHphKNglvbIRGigukHg7yby001MGIOcHu");



// Generate a secret token that will work for the callback
$secret = bin2hex(random_bytes(64));

// Save the secret token to the database
$sql = "UPDATE user_purchases SET secretkey = ? WHERE purchaseId = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('si', $secret, $purchaseID);
$stmt->execute();


$sql = "SELECT * FROM user_purchases WHERE purchaseId = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $purchaseID);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
  // header("Location: /");
}

die();

$purchase = $result->fetch_assoc();
$productPrice = $purchase['price'];


$checkout = $stripe->checkout->sessions->create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'product_data' => [
        'name' => 'Ticket',
      ],
      'unit_amount' => $productPrice * 100,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost:8080/profile/betalen/success.php?purchaseid=' . $purchaseID . '&secret=' . $secret,
  'cancel_url' => 'http://localhost:8080/profile/betalen/cancel.php?purchaseid=' . $purchaseID . '&secret=' . $secret,
]);

var_dump($_GET['purchaseid']);

header("Location: " . $checkout->url);




// $product = $stripe->products->create([
//   'name' => 'Starter pack',
//   'description' => 'Premium starter pack',
// ]);
// echo "Success! Here is your starter pack product id: " . $product->id . "\n";

// $price = $stripe->prices->create([
//   'unit_amount' => 8000,
//   'currency' => 'eur',
//   'product' => $product['id'],
// ]);
// echo "Success! Here is your starter pack price id: " . $price->id . "\n";





?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>