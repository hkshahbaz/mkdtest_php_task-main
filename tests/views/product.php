<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Single Product</title>

    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            height: 43px;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
        #card-errors{
            color: #fa755a;
        }
        #discount_code_message p{
            font-weight: 500;
            display: block;
            width: 100%;
            font-size: larger;
        }
    </style>
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
         <form action="<?= $GLOBALS['baseurl']?>product" method="POST" id="payment-form" class=" text-center">
                                          
                                            <input type="hidden" name="plan_id" value="<?= $val->id;?>">
                                            <input type="hidden" name="price" id="plan_price" value="<?= $val->price;?>">
                                            
                                            

                                            <input id="card-holder-name" type="text" class="form-control" name="name" placeholder="Card Holder Name" autocomplete="off">
                                            <div id="card-element" class="mt-3"></div>
                                            <div id="card-errors" role="alert"></div>

                                             

                                             
                                               
                                            

                                             <div class="row p-0 m-3 justify-content-center" id="discount_code_message"></div>

                                            <button type="submit" class="btn btn-theme text-white mt-3" id="purchase-btn">
                                                Pay Now
                                            </button>
                                        </form>
      </div>
    </div>
  </div>
</div>

    <div class="container mt-5 pt-5  pb-5">
            <div class="row justify-content-center pb-5">
                <div class="col-md-6">
                    
<script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
                     <script src="https://js.stripe.com/v3/"></script>
<script>


    // var stripe = Stripe(`pk_test_51IWQUwH8oljXErmdg6L4MhsuB6tDdmumlHFfyNaopty2U27pmRcqMX1c868zn838lGQtU1eYV6bKRSQtMFWf36VT00aNsvnTOE`);
    // var elements = stripe.elements();



 // END Validate coupan code using aJax request

            // Create a Stripe client.
            var stripe = Stripe("pk_test_51IWQUwH8oljXErmdg6L4MhsuB6tDdmumlHFfyNaopty2U27pmRcqMX1c868zn838lGQtU1eYV6bKRSQtMFWf36VT00aNsvnTOE");

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"proxima-nova", "Helvetica Neue", Helvetica, sans-serif',
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

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style, hidePostCode:true});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Disable The submit button on click
                document.getElementById('purchase-btn').disabled = true;

                var options = {
                    name: document.getElementById('card-holder-name').value,
                }
                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;

                        // Enable The submit button
                        document.getElementById('purchase-btn').disabled = false;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
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