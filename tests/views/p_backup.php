<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Single Product</title>
  </head>
  <body>
    

    <div class="container">
    	<div class="row">
    		<div class="col-12">
    			<h1 class="mt-5">Single Product Page</h1>
	    		<a href="<?= $GLOBALS['baseurl'];?>" class="btn btn-info">All Products</a>
    		</div>
    	</div>	
		<div class="row mt-5">
    		

    			<?php $val = $GLOBALS["product"]; ?>
    			<div class="col-8">
    			<div class="card" style="width: 30rem;">
				  <img class="card-img-top" src="<?= $val->image;?>" alt="Card image cap">
				  <div class="card-body">
				    <h5 class="card-title"><?= $val->title;?></h5>
                    <p class="card-text">Price: <?= $val->price;?></p>
                    <p class="card-text"><?= $val->description;?></p>
				    <a type="button" class="btn btn-info text-white w-100" data-toggle="modal" data-target="#exampleModalCenter">Buy </a>
				  </div>
				</div>
				</div>
				
	    		
    		
    	</div>

    	
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Stripe Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= $GLOBALS['baseurl']?>product" method="POST" id="subscribe-form" >
          
            <div class="form-group">
                <div class="row">
                   
                    <div class="col-md-4 d-none">
                        <div class="subscription-option">
                            <input type="radio" id="plan-silver" name="product_id" value="<?= $val->id;?>" checked  />
                            <input type="radio" id="plan-silver" name="product_price" value="<?= $val->price;?>" checked  />
                            <label for="plan-silver">
                                <span class="plan-price"><?= $val->price;?></span>
                                <span class="plan-name"><?= $val->title;?></span>
                            </label>
                        </div>
                    </div>
                 
                </div>
            </div>

            <div class="form-group">
                <label for="card-holder-name">Card Holder Name</label>
                <input id="card-holder-name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Name" >
            </div>

            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element" class="form-control"></div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="stripe-errors"></div>
            
           
            <div class="form-group text-center">
                <button id="card-button" data-secret="<?= $GLOBALS['client_secret']; ?>" class="btn btn-upload w-100 mt-4 mb-2">Pay</button>
            </div>      </form>
      </div>
    </div>
  </div>
</div>

    <div class="container mt-5 pt-5  pb-5">
            <div class="row justify-content-center pb-5">
                <div class="col-md-6">
                    

                    <script src="https://js.stripe.com/v3/"></script>
<script>


    var stripe = Stripe(`pk_test_51IWQUwH8oljXErmdg6L4MhsuB6tDdmumlHFfyNaopty2U27pmRcqMX1c868zn838lGQtU1eYV6bKRSQtMFWf36VT00aNsvnTOE`);
    var elements = stripe.elements();


    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    var card = elements.create('card', {hidePostalCode: true,
        style: style});
    

    card.mount('#card-element');
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    

    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', async(e) => {
        e.preventDefault();

        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: { name: cardHolderName.value }
                }
            }
            );
        if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {

            paymentMethodHandler(setupIntent.payment_method);
        }
    });
    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
                </div>
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>