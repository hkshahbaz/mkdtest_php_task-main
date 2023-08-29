<?php
require_once('vendor/autoload.php');
// require 'flight/Flight.php';
require 'mysql-adapter.php';


$ret = R::setup('mysql:host=localhost;dbname=testdatabase', 'root', '');


$GLOBALS["products"] = R::findAll( 'products'); //loads all products


$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$baseurl = "http://" . $host . $path . "/";

$GLOBALS["baseurl"] = $baseurl;

Flight::route('/', function(){
	
    include __DIR__.'/tests/views/index.php';
});

Flight::route('GET /product/@id', function($id){
	$GLOBALS["product"] = R::load( 'products', $id);


$stripe = new \Stripe\StripeClient(
  'sk_test_51IWQUwH8oljXErmds28KftkL6o6jYIcPgYbBdfEmCPSuAlIh0fgoS4NADcCmsIZbdQ3p5nbAeCOcGkSmo38U9BIe00BdOenrqo'
);
$intent = $stripe->setupIntents->create([
  'payment_method_types' => ['card'],
]);

	$GLOBALS["client_secret"] = $intent->client_secret; //client_secret


    include __DIR__.'/tests/views/product.php';
});

Flight::route('POST /product', function(){

	
	\Stripe\Stripe::setApiKey('sk_test_51IWQUwH8oljXErmds28KftkL6o6jYIcPgYbBdfEmCPSuAlIh0fgoS4NADcCmsIZbdQ3p5nbAeCOcGkSmo38U9BIe00BdOenrqo');
	$charge = \Stripe\Charge::create([
                "amount" => $_POST['price'] * 100,
                "currency" => "cad",
                "source" => $_POST['stripeToken'],
                "description" => "Payment transaction to buy product.",
                "capture" => true,
            ]);


	$order = R::dispense( 'orders' );
	$order->product_id = $_POST['plan_id'];
	$order->total = $_POST['price'];
	$order->stripe_id = $charge->id;
	$order->status = "paid";
   	$id = R::store( $order );

	$GLOBALS["product"] = R::load( 'products', $_POST['plan_id']);

     include __DIR__.'/tests/views/thankyou.php';
});


Flight::start();
