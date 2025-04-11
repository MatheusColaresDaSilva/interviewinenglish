<?php
require 'vendor/autoload.php';
$stripeSecretKey = getenv('STRIPE_SECRET_KEY');

\Stripe\Stripe::setApiKey($stripeSecretKey);

$baseSuccessUrl = 'http://localhost/interviewinenglish/redirect-success.php?plan=';

$plans = [
    'basic' => [
        'amount' => 2800,
        'success_url' => $baseSuccessUrl . 'basic',
        'name' => 'Basic Package 1 X 25min'
    ],
    'standard' => [
        'amount' => 7800,
        'success_url' => $baseSuccessUrl . 'standard',
        'name' => 'Standard Package 3 X 25 mins'
    ],
    'executive' => [
        'amount' => 14800,
        'success_url' => $baseSuccessUrl . 'executive',
        'name' => 'Premium Package 6 x 25 mins'
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['package'])) {
    $cancel_url = $_POST['cancel_url'] ?? 'https://interviewinenglish.com/';
    $packageId = $_POST['package'];

    if (!isset($plans[$packageId])) {
        http_response_code(400);
        echo "Invalid package selected.";
        exit();
    }

    $selectedPlan = $plans[$packageId];

    try {
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $selectedPlan['name'],
                    ],
                    'unit_amount' => $selectedPlan['amount'],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $selectedPlan['success_url'],
            'cancel_url' => $cancel_url,
            'allow_promotion_codes' => true,
            'phone_number_collection' => ['enabled' => true, ],
            'billing_address_collection' => 'required',
        ]);

        header("Location: " . $checkout_session->url);
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
